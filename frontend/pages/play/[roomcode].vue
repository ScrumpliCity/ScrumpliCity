<script setup>
definePageMeta({
  layout: "play-default",
});

defineI18nRoute({
  paths: {
    de: "/play/[roomcode]",
    en: "/play/[roomcode]",
  },
});

//@TODO: send name to backend
const teamName = ref("");
</script>
<template>
  <div class="flex h-screen w-full flex-col items-center">
    <h1 class="font-heading text-6xl font-bold text-sc-orange">
      {{ $t("join-room.team-title") }}
    </h1>
    <div class="relative mb-12 mt-16">
      <input
        class="rounded-lg border-2 border-sc-black-400 py-8 text-center text-5xl font-medium drop-shadow-sc-shadow"
        :placeholder="$t('join-room.team-name')"
        v-model="teamName"
      />
      <UIcon
        name="ic:round-check"
        class="absolute right-14 top-1/2 -translate-y-1/2 transform p-12 text-sc-green"
        v-if="teamName"
      />
    </div>
    <NuxtLinkLocale
      :to="{ name: 'play-members' }"
      class="w-72 rounded-lg py-6 text-center text-4xl font-bold drop-shadow-sc-shadow"
      :class="{
        'cursor-pointer bg-sc-green text-sc-black hover:bg-sc-green-400':
          teamName,
        'cursor-not-allowed bg-sc-black-400 text-sc-white': !teamName,
      }"
    >
      {{ $t("join-room.team-join") }}
    </NuxtLinkLocale>
  </div>
</template>
