<script setup>
definePageMeta({
  layout: "play-default",
});

//@TODO: check with room code from backend
const roomCode = ref("");

function navigateToTeamname() {
  navigateTo({ path: "/play/" + roomCode.value });
}
</script>

<template>
  <div class="flex h-full w-full flex-col items-center">
    <h1 class="font-heading text-6xl font-bold text-sc-orange">
      {{ $t("join-room.title") }}
    </h1>
    <div class="relative mb-12 mt-16">
      <input
        @keydown.enter="navigateToTeamname"
        class="rounded-lg border-2 border-sc-black-400 py-8 text-center text-5xl font-medium drop-shadow-sc-shadow"
        :placeholder="$t('join-room.code')"
        v-model="roomCode"
      />
      <UIcon
        name="ic:round-check"
        class="absolute right-14 top-1/2 -translate-y-1/2 transform p-12 text-sc-green"
        v-if="roomCode"
      />
    </div>
    <button
      @click="navigateToTeamname"
      class="w-72 rounded-lg py-6 text-center text-4xl font-bold drop-shadow-sc-shadow"
      :class="{
        'cursor-pointer bg-sc-green text-sc-black hover:bg-sc-green-400':
          roomCode,
        'cursor-not-allowed bg-sc-black-400 text-sc-white': !roomCode,
      }"
    >
      {{ $t("join-room.join") }}
    </button>
  </div>
</template>
