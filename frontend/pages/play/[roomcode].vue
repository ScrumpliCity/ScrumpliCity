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
  await game.changeName(teamName.value);
  await navigateTo(localRoute("play-members"));
}
</script>
<template>
  <div class="mt-10 flex h-full w-full flex-col items-center">
    <h1 class="font-heading text-6xl font-bold text-sc-orange">
      {{ $t("join_room.team_title") }}
    </h1>
    <input
      @keydown.enter="submit"
      class="mb-12 mt-16 rounded-lg border-2 border-sc-black-400 py-8 text-center text-5xl font-medium drop-shadow-sc-shadow"
      :placeholder="$t('join_room.team_name')"
      v-model="teamName"
    />
    <button
      @click="submit"
      :disabled="!teamName"
      class="w-72 cursor-pointer rounded-lg bg-sc-green py-6 text-center text-4xl font-bold text-sc-black drop-shadow-sc-shadow transition-colors hover:bg-sc-green-400 disabled:cursor-not-allowed disabled:bg-sc-black-400 disabled:text-sc-white"
    >
      {{ $t("join_room.team_join") }}
    </button>
  </div>
</template>
