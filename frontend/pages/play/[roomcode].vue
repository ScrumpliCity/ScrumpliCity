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
let selected = ref({});

function changeDisplaySelected() {
  selected.value = selected.value.name;
  teamName.value = selected.value;
}
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
    <USelectMenu
      v-else
      v-model="selected"
      :options="existingTeams"
      :placeholder="$t('join_room.team_name')"
      class="mt-16 w-96 rounded-lg"
      @change="changeDisplaySelected()"
    >
      <template #option="{ option: team }">
        <div class="flex flex-col items-center">
          <span class="truncate">{{ team.name }}</span>
          <span>{{ team.members.join(", ") }}</span>
        </div>
      </template>
    </USelectMenu>
    <button
      @click="submit"
      :disabled="!teamName"
      class="mt-12 w-72 cursor-pointer rounded-lg bg-sc-green py-6 text-center text-4xl font-bold text-sc-black drop-shadow-sc-shadow transition-colors hover:bg-sc-green-400 disabled:cursor-not-allowed disabled:bg-sc-black-400 disabled:text-sc-white"
    >
      {{ $t("join_room.team_join") }}
    </button>
  </div>
</template>
