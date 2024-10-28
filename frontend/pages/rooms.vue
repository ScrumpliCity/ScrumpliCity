<script setup>
definePageMeta({
  middleware: ["sanctum:auth"],
});
</script>

<template>
  <AppHeader />
  <!-- Slot for room creation popup -->
  <NuxtLink :to="localePath('rooms-create')">{{ $t("new") }} +</NuxtLink>
  <!-- @Felix-->
  <NuxtPage />
</template>
