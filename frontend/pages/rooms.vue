<script setup>
const { locale } = useI18n();
const localeRoute = useLocaleRoute();
const roomCreationIsOpen = ref(false);
</script>

<template>
  <AppHeader />
  <!-- Slot for room creation popup -->
  <NuxtLink :to="localePath('rooms-create')"
    >{{ $t("new") }} +</NuxtLink
  >
  <!-- @Felix-->
  <NuxtPage />
</template>
