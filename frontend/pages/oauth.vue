<script setup lang="ts">
definePageMeta({
  layout: "login",
});

function loginWithMicrosoft() {}
</script>

<template>
  <div class="relative flex h-full flex-col items-center pt-32">
    <h1
      class="pb-16 text-center font-heading text-5xl font-bold text-sc-orange"
    >
      {{ $t("login.log_in_to_scrumplicity") }}
    </h1>
    <p class="pb-7 text-center font-heading text-3xl font-medium">
      {{ $t("login.log_in_with") }}
    </p>

    <UButton
      @click="loginWithMicrosoft"
      icon="logos:microsoft-icon"
      block
      size="xl"
      class="w-64 bg-sc-black-300 text-center text-xl font-bold text-sc-white transition hover:bg-sc-black-400"
      >{{ $t("login.microsoft") }}</UButton
    >

    <p class="absolute bottom-[1vw] left-[50vw] -translate-x-1/2 bg-sc-white font-bold text-sc-black-500 text-2xl">
      {{ $t("common.imprint") }}
    </p>
  </div>
</template>
