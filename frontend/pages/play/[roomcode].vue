<script setup>
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
  await game.changeName(teamName.value);
  if (roomAlreadyPlayed) {
    //await navigateTo(localRoute("ready"));
    console.log("TODO: navigate to ready");
  } else {
    await navigateTo(localRoute("play-members"));
  }
}

//TODO: check if "last_play_start" is not null => Spiel noch nie gestartet
const roomAlreadyPlayed = true;
//TODO: get existing teams from backend
const existingTeams = [
  {
    name: "ScrumpliCity",
    members: [
      "Felix Wollmann",
      "Marco Janderka",
      "Lisa-Marie Hörmann",
      "Sophie Nemecek",
    ],
  },
  {
    name: "JourneyPlanner",
    members: [
      "Raven Burkard",
      "Severin Rosner",
      "Stefania Manastirska",
      "Roman Krebs",
    ],
  },
  {
    name: "LinguExplorer",
    members: [
      "Tien Luong",
      "Alexander Nems",
      "Helena Stindl",
      "Benjamin Bician",
      "Britta Müller",
    ],
  },
  {
    name: "Specialbond",
    members: [
      "Anil Kapan",
      "Arlon Labalan",
      "Paula Wenighofer",
      "Joavan Stojanovic",
    ],
  },
];
let selected = ref();

function changeSelected(team) {
  selected = team;
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
      class="mt-16 max-h-[40vh] w-fit cursor-pointer overflow-scroll rounded-lg border-2 border-sc-black-400 bg-sc-white py-8 text-center text-5xl font-medium drop-shadow-sc-shadow"
    >
      <p v-if="selected?.name" class="text-sc-black-400">
        {{ selected.name }}
      </p>
      <p v-else class="text-sc-black-400">
        {{ $t("join_room.team_name") }}
      </p>
      <div
        v-if="dropdownOpen"
        class="flex flex-col items-center justify-center"
      >
        <div
          v-for="team in existingTeams"
          :key="team.name"
          @click="changeSelected(team)"
          class="w-full px-14 hover:bg-sc-black-200"
        >
          <button
            class="flex flex-col items-center border-b-2 border-sc-black py-6"
          >
            <p class="mb-1 text-3xl font-bold">{{ team.name }}</p>
            <p class="text-xs">{{ team.members.join(", ") }}</p>
          </button>
        </div>
      </div>
    </div>
    <button
      v-if="!dropdownOpen"
      @click="submit"
      :disabled="!teamName"
      class="mt-12 w-72 cursor-pointer rounded-lg bg-sc-green py-6 text-center text-4xl font-bold text-sc-black drop-shadow-sc-shadow transition-colors hover:bg-sc-green-400 disabled:cursor-not-allowed disabled:bg-sc-black-400 disabled:text-sc-white"
    >
      {{ $t("join_room.team_join") }}
    </button>
  </div>
</template>
