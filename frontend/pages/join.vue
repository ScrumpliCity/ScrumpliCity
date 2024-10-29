<script setup>
const switchLocalePath = useSwitchLocalePath();
</script>
<template>
  <div class="flex items-center justify-center h-screen">
    <div class="flex flex-col items-center">
      <NuxtLink :to="switchLocalePath('de')">Deutsch</NuxtLink>
      <NuxtLink :to="switchLocalePath('en')">English</NuxtLink>
      <h1 class="text-6xl text-sc-orange font-heading font-bold">{{ $t("join-room.title") }}</h1>
      <input class="border-2 border-sc-black-400 drop-shadow-sc-48025 text-center mt-16 mb-12 text-5xl px-36 py-16 rounded-lg font-medium" :placeholder="$t('join-room.code')">
      <button class="bg-sc-black-400 text-white font-bold text-center text-4xl py-6 w-72 rounded-lg drop-shadow-sc-48025">{{ $t("join-room.join") }}</button>
    </div>
  </div>
</template>
