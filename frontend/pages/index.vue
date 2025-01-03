<script setup>
// Demo für Routing zu lokalen Seiten und Sprachwechsel
const { locale, setLocale } = useI18n();
const localeRoute = useLocaleRoute();

// demo for data fetching
const client = useSanctumClient();
</script>

<template>
  <div>
    <div>
      <button @click="setLocale('de')">de</button>
      <br />
      <button @click="setLocale('en')">en</button>
      <p class="font-heading font-black">{{ $t("welcome") }}</p>
      <NuxtLink
        :to="localeRoute('play', locale)"
        class="font-heading font-thin"
        >{{ $t("join") }}</NuxtLink
      >
    </div>
  </div>
</template>
