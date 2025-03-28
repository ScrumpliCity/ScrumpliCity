<script setup>
const { t } = useI18n();
const echo = useEcho();

useSeoMeta({
  title: t("join_room.page_title"),
});

definePageMeta({
  layout: "play",
  middleware: (to) => {
    const code = to.params.roomcode;
    if (!isRoomCodeCheckDigitValid(code)) {
      const localeRoute = useLocaleRoute();
      return navigateTo(localeRoute("play"), {
        replace: true,
        redirectCode: 404,
      });
    }
  },
});

const localeRoute = useLocaleRoute();
const route = useRoute();

const game = useGameStore();

const { data: roomWithAllExistingTeamsAndMembers } = await useAsyncData(
  "team-join",
  async () => game.getRoomByRoomcode(route.params.roomcode),
);

const ableToSelectExistingTeams = computed(() => {
  return roomWithAllExistingTeamsAndMembers.value.last_play_end;
});

const inactiveTeamsToDisplay = computed(() => {
  return roomWithAllExistingTeamsAndMembers.value.teams?.filter(
    (team) => !team.active,
  );
});

onMounted(async () => {
  try {
    if (ableToSelectExistingTeams.value) {
      try {
        // Subscribe to team updates to only display inactive teams
        echo
          .channel(`rooms.${roomWithAllExistingTeamsAndMembers.value.id}`)
          .listen(".TeamUpdated", (data) => {
            //set data.model.id in roomWithAllExistingTeamsAndMembers.value.teams to active if data.model.active is 1 so the team is not available in inactiveTeamsToDisplay
            const team = roomWithAllExistingTeamsAndMembers.value.teams.find(
              (team) => team.id === data.model.id,
            );
            if (team && data.model.active) {
              team.active = true;
            }
          })
          .error((e) => {
            console.error("Channel error:", e);
          });
      } catch (error) {
        console.error("Failed to subscribe to team updates: ", error);
      }
    } else {
      await game.joinRoom(route.params.roomcode);
    }
  } catch (error) {
    await navigateTo(localeRoute("play"), {
      replace: true,
      redirectCode: 404,
    });
    console.error("Failed to join room: ", error);
  }
});

const teamName = ref("");

async function submit() {
  if (ableToSelectExistingTeams.value) {
    await game.selectExistingTeam(route.params.roomcode, selected.id);
    await navigateTo(localeRoute("play-ready"));
  } else {
    await game.changeName(teamName.value);
    await navigateTo(localeRoute("play-members"));
  }
}
let selected = ref();

function changeSelected(team) {
  selected = team;
  dropdownOpen.value = false;
}

const dropdownOpen = ref(false);

onBeforeUnmount(() => {
  echo.leaveChannel(`rooms.${roomWithAllExistingTeamsAndMembers.value.id}`);
});
</script>
<template>
  <div class="mt-10 flex h-full w-full flex-col items-center">
    <h1
      v-if="!ableToSelectExistingTeams"
      class="font-heading text-6xl font-bold text-sc-orange"
    >
      {{ $t("join_room.team_title") }}
    </h1>
    <h1 v-else class="font-heading text-6xl font-bold text-sc-orange">
      {{ $t("join_room.choose_existing_team") }}
    </h1>
    <input
      v-if="!ableToSelectExistingTeams"
      @keydown.enter="submit"
      class="mt-16 rounded-lg border-2 border-sc-black-400 py-8 text-center text-5xl font-medium drop-shadow-sc-shadow"
      :placeholder="$t('join_room.team_name')"
      v-model="teamName"
    />
    <div
      v-else
      @click="dropdownOpen = !dropdownOpen"
      tabindex="0"
      @keydown.space="dropdownOpen = !dropdownOpen"
      class="relative mt-16 min-h-[132.8px] w-[660.2px] cursor-pointer items-center justify-center overflow-y-auto rounded-lg border-2 border-sc-black-400 bg-sc-white py-8 text-center text-5xl font-medium drop-shadow-sc-shadow"
    >
      <p
        v-if="selected"
        class="flex h-full items-center justify-center text-sc-black"
      >
        {{ selected.name }}
      </p>
      <p
        v-else
        class="flex h-full items-center justify-center text-sc-black-400"
      >
        {{ $t("join_room.team_name") }}
      </p>
      <UIcon
        name="ep:arrow-up-bold"
        class="absolute right-14 top-1/2 -translate-y-1/2 transform text-sc-orange transition-transform"
        :class="{ 'rotate-180': !dropdownOpen }"
      />
    </div>
    <div
      v-if="dropdownOpen"
      class="relative mt-3 max-h-[30vh] w-[660.2px] cursor-pointer flex-col items-center justify-center divide-y-2 divide-sc-black overflow-y-auto rounded-lg border-2 border-sc-black-400 bg-sc-white px-6 text-center text-5xl font-medium drop-shadow-sc-shadow"
    >
      <div
        v-for="team in inactiveTeamsToDisplay"
        :key="team.id"
        @click="changeSelected(team)"
        class="flex w-full items-center justify-center py-10 hover:bg-sc-black-200"
      >
        <button class="flex w-full flex-col items-center">
          <p class="mb-1 text-3xl font-bold">{{ team.name }}</p>
          <p class="text-xs">
            {{ team.members.map((member) => member.name).join(", ") }}
          </p>
        </button>
      </div>
      <p v-if="inactiveTeamsToDisplay.length === 0" class="m-4 text-base">
        {{ $t("join_room.no_teams_available") }}
      </p>
    </div>
    <button
      v-if="!dropdownOpen"
      @click="submit"
      :disabled="teamName === '' && !selected"
      class="mt-12 w-72 cursor-pointer rounded-lg bg-sc-green py-6 text-center text-4xl font-bold text-sc-black drop-shadow-sc-shadow transition-colors hover:bg-sc-green-400 disabled:cursor-not-allowed disabled:bg-sc-black-400 disabled:text-sc-white"
    >
      {{ $t("join_room.team_join") }}
    </button>
  </div>
</template>
