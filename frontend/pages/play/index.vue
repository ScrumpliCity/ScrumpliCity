<script setup>
definePageMeta({
  layout: "play",
});

const localeRoute = useLocaleRoute();

const roomCode = ref("");

const roomCodeIsValid = computed(() =>
  isRoomCodeCheckDigitValid(roomCode.value),
);

async function navigateToTeamname() {
  await navigateTo(localeRoute({ path: `/play/${roomCode.value}` }));
}
</script>

<template>
  <div class="mt-10 flex h-full w-full flex-col items-center">
    <h1 class="font-heading text-6xl font-bold text-sc-orange">
      {{ $t("join_room.title") }}
    </h1>
    <div class="relative mb-12 mt-16">
      <input
        @keydown.enter="navigateToTeamname"
        class="rounded-lg border-2 border-sc-black-400 py-8 text-center text-5xl font-medium drop-shadow-sc-shadow"
        :placeholder="$t('join_room.code')"
        v-model="roomCode"
      />
      <UIcon
        name="ic:round-check"
        class="absolute right-14 top-1/2 -translate-y-1/2 transform p-12 text-sc-green transition-opacity"
        :class="{ 'opacity-0': !roomCodeIsValid }"
        v-if="roomCodeIsValid"
      />
    </div>
    <button
      @click="navigateToTeamname"
      :disabled="!roomCodeIsValid"
      class="w-72 cursor-pointer rounded-lg bg-sc-green py-6 text-center text-4xl font-bold text-sc-black drop-shadow-sc-shadow transition-colors hover:bg-sc-green-400 disabled:cursor-not-allowed disabled:bg-sc-black-400 disabled:text-sc-white"
    >
      {{ $t("join_room.join") }}
    </button>
  </div>
</template>
