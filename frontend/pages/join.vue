<script setup xmlns="http://www.w3.org/1999/html">
const switchLocalePath = useSwitchLocalePath();

//@TODO: get room code from backend and render check and button accordantly
const tempBool = ref(false);
</script>
<template>
  <div class="flex h-screen items-center justify-center">
    <div class="flex flex-col items-center">
      <NuxtLink :to="switchLocalePath('de')">Deutsch</NuxtLink>
      <NuxtLink :to="switchLocalePath('en')">English</NuxtLink>
      <h1 class="font-heading text-6xl font-bold text-sc-orange">
        {{ $t("join-room.title") }}
      </h1>
      <div class="relative mb-12 mt-16">
        <input
          class="w-full rounded-lg border-2 border-sc-black-400 px-32 py-16 text-center text-5xl font-medium drop-shadow-sc-48025"
          :placeholder="$t('join-room.code')"
          @input="tempBool = !tempBool"
        />
        <UIcon
          name="ic:round-check"
          class="absolute right-14 top-1/2 -translate-y-1/2 transform p-14 text-sc-green"
          v-if="tempBool"
        />
      </div>
      <button
        :disabled="!tempBool"
        class="w-72 rounded-lg bg-sc-black-400 py-6 text-center text-4xl font-bold text-white drop-shadow-sc-48025"
        :class="{ 'bg-sc-green text-sc-black hover:bg-sc-green-400': tempBool }"
      >
        {{ $t("join-room.join") }}
      </button>
    </div>
  </div>
</template>
