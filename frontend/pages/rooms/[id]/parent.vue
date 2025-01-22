<script setup>
const client = useSanctumClient();
const localeRoute = useLocaleRoute();
const route = useRoute();
const localePath = useLocalePath();
const { t } = useI18n();
const echo = useEcho();
const toast = useToast();

const { data, refresh } = await useAsyncData("room", () =>
  client(`/api/rooms/${route.params.id}`),
);
const manageRoom = computed(() => data.value);

const isOpen = ref(false);
const timerPaused = ref(false);

const teamReadyStates = ref({});

const remainingSeconds = ref(0);
const totalSeconds = ref(0);
const isPlaying = computed(() => !!manageRoom.value.is_playing);

// DEV: The active field in teams should indicate an active connection to a team that at some point joined has this room
const activeTeams = computed(
  () => manageRoom.value.teams.filter((team) => team.active).length,
);

// For the created/playing/completed/... status text
const statusText = computed(() => {
  if (!manageRoom.value) return ""; // If the room is not loaded yet

  if (manageRoom.value.completed_at) {
    return t("rooms.completed");
  }
  if (!manageRoom.value.roomcode) {
    return t("rooms.ready");
  }
  if (isPlaying.value) {
    return t("rooms.currently_playing");
  }
  return t("rooms.started");
});

const allTeamsReady = computed(() => {
  return Object.values(teamReadyStates.value).every((isReady) => isReady);
});

const lastPlayedAgoMinutes = computed(() => {
  const lastPlayStart = manageRoom.value?.last_play_start;
  if (lastPlayStart) {
    return Math.floor(
      (Date.now() - new Date(lastPlayStart).getTime()) / 1000 / 60,
    );
  }
  return undefined;
});

onMounted(() => {
  // Refresh the room when coming back from the edit room page
  watch(
    () => route.path,
    (newPath, oldPath) => {
      if (
        oldPath ===
          localePath({
            name: "rooms-id-parent-edit",
            params: { id: manageRoom.value.id },
          }) &&
        newPath ===
          localePath({
            name: "rooms-id-parent",
            params: { id: manageRoom.value.id },
          })
      ) {
        refresh();
      }
    },
  );

  if (!echo) return;

  // Subscribe to channels for real-time updates: rooms, their teams and members
  echo
    .channel(`rooms.${manageRoom.value.id}`)
    .listen(".TeamCreated", () => refresh())
    .listen(".TeamUpdated", () => refresh())
    .listen(".MemberCreated", () => refresh())
    .error((e) => {
      console.error("Channel error:", e);
    });

  // Subscribe to channels for real-time updates: timer
  echo
    .channel(`timer.${manageRoom.value.id}`)
    .listen("TimerUpdate", (data) => {
      if (data.remainingSeconds !== remainingSeconds.value)
        remainingSeconds.value = data.remainingSeconds;
    })
    .listen("TimerStateChange", (data) => {
      remainingSeconds.value = data.remainingSeconds;
      totalSeconds.value = data.totalSeconds;
      refresh();
    })
    .error((e) => {
      console.error("Channel error:", e);
    });
});

onBeforeUnmount(() => {
  echo.leave(`rooms.${manageRoom.value.id}`);
  echo.leave(`timer.${manageRoom.value.id}`);
});

function openRoomCode() {
  navigateTo(
    localeRoute({
      name: "rooms-id-roomcode",
      params: { id: manageRoom.id },
    }),
    {
      open: {
        target: "_blank",
        windowFeatures: { popup: true },
      },
    },
  );
  // Roomcode view needs time to load, therefore, refresh only after 3 seconds
  setTimeout(refresh, 3000);
  refresh();
}

async function togglePlaying() {
  try {
    await client(`/api/rooms/${manageRoom.value.id}/playing-status`, {
      method: "PATCH",
    });
    refresh();
  } catch (error) {
    toast.add({
      title: t("rooms.toggle_playing_error", {
        status: isPlaying ? t("rooms.pause") : t("rooms.start"),
      }),
      variant: "error",
    });
    return;
  }
}

async function toggleTimer() {
  try {
    await client(
      `/api/rooms/${manageRoom.value.id}/timer/${timerPaused.value ? "resume" : "pause"}`,
      {
        method: "POST",
      },
    );
    await refresh();
    timerPaused.value = !timerPaused.value;
  } catch (error) {
    toast.add({
      title: t("rooms.toggle_playing_error", {
        status: isPlaying ? t("rooms.pause") : t("rooms.start"),
      }),
      variant: "error",
    });
  }
}

function copyRoomCode() {
  navigator.clipboard.writeText(manageRoom.value.roomcode);
  toast.add({
    title: t("rooms.room_code_copied"),
    variant: "success",
  });
}
</script>
<template>
  <div class="h-screen overflow-clip">
    <AppHeader />
    <div
      class="absolute top-16 flex h-fit flex-col items-end gap-7 sm:right-6 xl:right-36"
      :class="{
        'top-[24.75rem]': manageRoom.completed_at,
      }"
    >
      <LazyTimer
        :remainingSeconds="remainingSeconds"
        :totalSeconds="totalSeconds"
        :isControllable="true"
        :isPaused="timerPaused"
        :isDisabled="!isPlaying"
        v-if="manageRoom.roomcode && !manageRoom.completed_at"
        @toggle="toggleTimer"
        :isPlaying
      />

      <LazyPhaseBox
        v-if="manageRoom.roomcode"
        :room="manageRoom"
        :currentSprint="manageRoom.current_sprint"
        :sprintCount="manageRoom.number_of_sprints"
        :phase="manageRoom.current_phase"
        :key="`${manageRoom.current_phase}-${manageRoom.current_sprint}`"
        :isCompleted="!!manageRoom.completed_at"
      />
    </div>
    <div class="flex flex-col gap-7">
      <div class="flex flex-col gap-2">
        <div class="ml-5 mr-10 mt-10 flex justify-between">
          <div class="flex items-center gap-3">
            <UButton
              variant="ghost"
              @click="navigateTo(localeRoute('rooms-parent'))"
              class="p-0 hover:bg-transparent"
            >
              <SvgArrowLeft filled class="size-10" :fontControlled="false" />
            </UButton>

            <div class="flex items-center gap-5">
              <h1 class="font-heading text-5xl font-bold text-sc-orange">
                {{ manageRoom.name }}
              </h1>
              <UTooltip :text="statusText" class="flex-none">
                <UIcon
                  name="material-symbols:cycle"
                  class="size-10 text-sc-green-500 hover:animate-[spin_2s_linear_infinite]"
                  v-if="isPlaying"
                />
                <SvgStatusArrow
                  :class="{
                    'text-sc-orange': manageRoom.completed_at,
                    'text-sc-yellow': !manageRoom.roomcode,
                    'text-sc-green':
                      !manageRoom.completed_at && manageRoom.roomcode,
                  }"
                  class="size-10 flex-none text-gray-300"
                  filled
                  :fontControlled="false"
                  v-else
                />
              </UTooltip>
            </div>
          </div>

          <UButton
            variant="ghost"
            icon="material-symbols:settings-outline-rounded"
            class="text-sc-orange *:size-9 hover:bg-transparent"
            @click="
              navigateTo(
                localeRoute({
                  name: 'rooms-id-parent-edit',
                  params: { id: manageRoom.id },
                }),
              )
            "
            :disabled="isPlaying || manageRoom.completed_at"
          />
        </div>
        <div
          v-show="manageRoom.roomcode && !manageRoom.completed_at"
          class="ml-[4.6875rem] flex items-center gap-1 text-sm"
        >
          <strong class="font-semibold text-sc-black"
            >{{ $t("rooms.room_code") }}:
          </strong>
          <UTooltip
            :text="$t('rooms.copy_room_code')"
            class="flex-none"
            :key="manageRoom.roomcode"
          >
            <UButton
              variant="ghost"
              icon="ic:baseline-content-copy"
              class="p-0 text-sc-black-300 hover:bg-transparent"
              :ui="{ icon: { size: 'size-3' } }"
              :trailing="true"
              @click="copyRoomCode"
            >
              <span class="font-normal text-sc-black">{{
                manageRoom.roomcode
              }}</span>
            </UButton>
          </UTooltip>
        </div>
      </div>

      <div class="flex flex-col gap-4">
        <div class="ml-[5.65rem] flex items-center gap-4 text-lg font-bold">
          <UIcon
            name="material-symbols:calendar-today-outline-rounded"
            class="size-9 text-sc-orange"
          />
          <p v-if="isPlaying">
            {{
              $t("rooms.running_for", [
                lastPlayedAgoMinutes >= 60
                  ? `${Math.floor(lastPlayedAgoMinutes / 60)}h`
                  : `${lastPlayedAgoMinutes}min`,
              ])
            }}
          </p>
          <p v-else-if="manageRoom.completed_at">
            {{
              $t("rooms.completed_on", [
                $d(new Date(manageRoom.completed_at), "custom"),
              ])
            }}
          </p>
          <p v-else>
            {{
              $t("rooms.created_on", [
                $d(new Date(manageRoom.created_at), "custom"),
              ])
            }}
          </p>
        </div>

        <div
          class="z-10 ml-[4.5rem] w-[calc(100vw-34.25rem)] cursor-pointer overflow-y-auto rounded-lg border border-sc-black-400 bg-sc-black-50 drop-shadow xl:w-[calc(86vw-34.25rem)]"
          :class="{ 'h-[calc(64vh-1.75rem)]': isOpen }"
          @click="isOpen = !isOpen"
        >
          <div class="flex justify-between py-2">
            <div class="ml-5 mr-2 flex w-full items-center justify-between">
              <div class="flex items-center justify-between gap-4">
                <UIcon
                  name="gravity-ui:persons"
                  class="size-9 text-sc-orange"
                />
                <span class="text-lg font-bold">{{
                  (manageRoom.teams.length != activeTeams
                    ? activeTeams + " / "
                    : "") + $t("rooms.teams", manageRoom.teams.length)
                }}</span>
              </div>

              <span
                class="transform transition-transform duration-300"
                :class="{ 'rotate-180': isOpen }"
              >
                <SvgArrowLeft
                  filled
                  class="size-10 -rotate-90"
                  :fontControlled="false"
                />
              </span>
            </div>
          </div>
          <div
            v-show="isOpen"
            class="flex h-[calc(100%-3.5rem)] flex-wrap gap-x-3 gap-y-2 px-4 py-2"
          >
            <TeamManager
              @click.stop
              v-for="team in manageRoom.teams"
              :key="team.members"
              :team
              :isPlaying="isPlaying"
              @update="refresh()"
              @isReadyChanged="
                (isReady, teamId) => (teamReadyStates[teamId] = isReady)
              "
              :isDisabled="manageRoom.completed_at"
            />
            <p
              v-if="manageRoom.teams.length <= 0"
              class="mb-14 w-full self-end text-center text-lg text-sc-black"
            >
              {{ $t("rooms.no_teams_yet") }}
            </p>
          </div>
        </div>
      </div>
      <UButton
        @click="openRoomCode"
        class="absolute bottom-9 right-9 z-10 h-16 w-[336px] justify-center text-2xl font-bold hover:bg-sc-orange-700"
        v-if="!manageRoom.roomcode"
      >
        {{ $t("generate_room_code.generate_code") }}</UButton
      >
    </div>
    <UPopover
      mode="hover"
      class="absolute bottom-5 right-9 active:pointer-events-none disabled:pointer-events-auto"
      :disabled="allTeamsReady"
    >
      <template #panel>
        <p class="w-80 p-3">
          {{ $t("rooms.product_owner_or_scrum_master_required") }}
        </p>
      </template>
      <UButton
        @click="togglePlaying"
        :icon="
          isPlaying ? 'mage:pause-fill' : 'material-symbols:play-arrow-rounded'
        "
        v-show="!manageRoom.completed_at && manageRoom.roomcode"
        class="pointer-events-auto z-20 flex size-[5.625rem] items-center justify-center bg-sc-orange hover:bg-sc-orange-700 disabled:bg-sc-black-400 disabled:opacity-100"
        :ui="{
          rounded: 'rounded-full',
          icon: {
            size: { sm: isPlaying ? 'size-[3.875rem]' : 'size-20' },
          },
        }"
        :disabled="!allTeamsReady || manageRoom.teams.length <= 0"
      ></UButton>
    </UPopover>

    <SvgGameManagementBg
      class="absolute bottom-0 ml-10 mr-20"
      :fontControlled="false"
      filled
    />
    <NuxtPage />
  </div>
</template>
