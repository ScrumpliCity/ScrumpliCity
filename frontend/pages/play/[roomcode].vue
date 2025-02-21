<script setup>
const { t } = useI18n();

useSeoMeta({
  title: t("join_room.page_title"),
});

definePageMeta({
  layout: "play",
  middleware: (to, from) => {
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

const game = useGameStore();

const { data: joinSuccess } = useAsyncData("team-join", async () => {
  try {
    const game = useGameStore();
    const route = useRoute();
    await game.joinRoom(route.params.roomcode);
    return "success";
  } catch (error) {
    return "failure";
  }
});

watch(
  joinSuccess,
  async () => {
    if (joinSuccess.value === "failure") {
      await navigateTo(localeRoute("play"), {
        replace: true,
        redirectCode: 404,
      });
    }
  },
  {
    immediate: true,
  },
);

const localRoute = useLocaleRoute();

const teamName = ref("");

async function submit() {
  if (roomAlreadyPlayed) {
    //TODO: await navigateTo(localRoute("ready"));
  } else {
    await game.changeName(teamName.value);
    await navigateTo(localRoute("play-members"));
  }
}

//TODO: check if "last_play_start" is not null => Spiel noch nie gestartet
const roomAlreadyPlayed = ref(true);
//TODO: get existing teams from backend
const existingTeams = [
  {
    name: "ScrumpliCity",
    members: ["Felix", "Marco", "Lisa-Marie", "Sophie"],
  },
  {
    name: "JourneyPlanner",
    members: ["Raven", "Severin", "Stefania", "Roman"],
  },
  {
    name: "LinguExplorer",
    members: ["Tien", "Alexander", "Helena", "Benjamin", "Britta"],
  },
  {
    name: "Specialbond",
    members: ["Anil", "Arlon", "Paula", "Jovana"],
  },
];
let selected = ref();

function changeSelected(team) {
  selected = team;
  dropdownOpen.value = false;
}

const dropdownOpen = ref(false);
</script>
<template>
  <div class="mt-10 flex h-full w-full flex-col items-center">
    <h1
      v-if="!roomAlreadyPlayed"
      class="font-heading text-6xl font-bold text-sc-orange"
    >
      {{ $t("join_room.team_title") }}
    </h1>
    <h1 v-else class="font-heading text-6xl font-bold text-sc-orange">
      {{ $t("join_room.choose_existing_team") }}
    </h1>
    <input
      v-if="!roomAlreadyPlayed"
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
      class="relative mt-3 max-h-[30vh] w-[660.2px] cursor-pointer flex-col items-center justify-center overflow-y-auto rounded-lg border-2 border-sc-black-400 bg-sc-white text-center text-5xl font-medium drop-shadow-sc-shadow"
    >
      <div
        v-for="team in existingTeams"
        :key="team.name"
        @click="changeSelected(team)"
        class="flex w-full items-center justify-center px-6 hover:bg-sc-black-200"
      >
        <button
          class="flex w-full flex-col items-center py-10"
          :class="[
            {
              'border-t-2 border-sc-black': team !== existingTeams[0],
            },
          ]"
        >
          <p class="mb-1 text-3xl font-bold">{{ team.name }}</p>
          <p class="text-xs">{{ team.members.join(", ") }}</p>
        </button>
      </div>
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
