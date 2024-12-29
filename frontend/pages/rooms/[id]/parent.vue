<script setup>
const client = useSanctumClient();
const localeRoute = useLocaleRoute();
const route = useRoute();
const localePath = useLocalePath();
const { t } = useI18n();

const { data, refresh } = await useAsyncData("room", () =>
  client(`/api/rooms/${route.params.id}`),
);
const manageRoom = computed(() => data.value);

const isOpen = ref(false);
const timerPaused = ref(false);

const teamReadyStates = ref({});

// const totalDuration =

const activeTeams = computed(
  () => manageRoom.value.teams.filter((team) => team.active).length,
);

const svgClass = computed(() => {
  if (!manageRoom.value) return "size-10 flex-none text-gray-300"; // If the room is not loaded yet

  if (manageRoom.value.completed_at) {
    return "size-10 flex-none text-sc-orange";
  }
  if (!manageRoom.value.roomcode) {
    return "size-10 flex-none text-sc-yellow";
  }
  return "size-10 flex-none text-sc-green";
});

const statusText = computed(() => {
  if (!manageRoom.value) return ""; // If the room is not loaded yet

  if (manageRoom.value.completed_at) {
    return t("rooms.completed");
  }
  if (!manageRoom.value.roomcode) {
    return t("rooms.ready");
  }
  if (manageRoom.value.is_playing) {
    return t("rooms.currently_playing");
  }
  return t("rooms.started");
});

const allTeamsReady = computed(() => {
  return Object.values(teamReadyStates.value).every((isReady) => isReady);
});

console.log(manageRoom.value); // Remove

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
        status: manageRoom.value.is_playing
          ? t("rooms.pause")
          : t("rooms.start"),
      }),
      variant: "error",
    });
    return;
  }
}
</script>
<template>
  <div class="h-screen overflow-clip">
    <AppHeader />
    <div
      class="absolute top-20 flex flex-col items-end gap-7 sm:right-6 xl:right-24"
    >
      <Timer
        :remainingSeconds="manageRoom.remainingSeconds ?? 300"
        :totalSeconds="manageRoom.totalSeconds ?? 300"
        :isControllable="true"
        :isPaused="timerPaused"
        :isDisabled="!manageRoom.is_playing"
        v-if="manageRoom.roomcode"
        @toggle="timerPaused = !timerPaused"
      />

      <PhaseBox
        v-if="manageRoom.roomcode"
        :room="manageRoom"
        :currentSprint="manageRoom.current_sprint"
        :sprintCount="manageRoom.number_of_sprints"
        :phase="manageRoom.current_phase"
      />
    </div>
    <div class="flex flex-col gap-12">
      <div class="ml-5 mr-10 mt-10 flex justify-between">
        <div class="flex items-center gap-3">
          <UButton
            variant="ghost"
            @click="navigateTo(localeRoute('rooms-parent'))"
            class="p-0 hover:bg-transparent"
          >
            <SvgArrowLeft
              filled
              class="size-10"
              @click="navigateTo(localeRoute('rooms-parent'))"
              :fontControlled="false"
            />
          </UButton>

          <div class="flex items-center gap-5">
            <h1 class="font-heading text-5xl font-bold text-sc-orange">
              {{ manageRoom.name }}
            </h1>
            <UTooltip :text="statusText" class="flex-none">
              <UIcon
                name="material-symbols:cycle"
                class="size-10 text-sc-green-500 hover:animate-[spin_2s_linear_infinite]"
                v-if="manageRoom.is_playing"
              />
              <SvgStatusArrow
                :class="svgClass"
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
        />
      </div>
      <div class="flex flex-col gap-4">
        <div class="ml-[5.65rem] flex items-center gap-4 text-lg font-bold">
          <UIcon
            name="material-symbols:calendar-today-outline-rounded"
            class="size-9 text-sc-orange"
          />
          <p v-if="manageRoom.is_playing">
            {{ $t("rooms.running_for") }}
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
          class="z-10 ml-[4.5rem] w-[735px] cursor-pointer overflow-y-auto rounded-lg border border-sc-black-400 bg-sc-black-50 drop-shadow"
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
                  (manageRoom.is_playing ? activeTeams + " / " : "") +
                  $t("rooms.teams", manageRoom.teams.length)
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
            class="flex h-[21rem] flex-wrap gap-x-3 gap-y-2 px-4 py-2"
          >
            <TeamManager
              @click.stop
              v-for="team in manageRoom.teams"
              :key="team.members"
              :team="team"
              :isPlaying="!!manageRoom.is_playing"
              @update="refresh()"
              @isReadyChanged="
                (isReady, teamId) => (teamReadyStates[teamId] = isReady)
              "
              :isDisabled="manageRoom.completed_at ? true : false"
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
      v-if="manageRoom.roomcode"
    >
      <template #panel>
        <p class="w-80 p-3">
          {{ $t("rooms.product_owner_or_scrum_master_required") }}
        </p>
      </template>
      <UButton
        @click="togglePlaying"
        :icon="
          manageRoom.is_playing
            ? 'mage:pause-fill'
            : 'material-symbols:play-arrow-rounded'
        "
        class="pointer-events-auto z-20 flex size-[5.625rem] items-center justify-center bg-sc-orange hover:bg-sc-orange-700 disabled:bg-sc-black-400 disabled:opacity-100"
        :ui="{
          rounded: 'rounded-full',
          icon: {
            size: { sm: manageRoom.is_playing ? 'size-[3.75em]' : 'size-20' },
          },
        }"
        :disabled="!allTeamsReady"
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
