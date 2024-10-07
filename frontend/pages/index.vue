<script setup>
// Demo für Routing zu lokalen Seiten und Sprachwechsel
const { locale, setLocale } = useI18n();
const localeRoute = useLocaleRoute();
</script>

<template>
  <div>
    <div>
      <button @click="setLocale('de')">de</button>
      <br />
      <button @click="setLocale('en')">en</button>
      <p>{{ $t("welcome") }}</p>
      <NuxtLink :to="localeRoute('join', locale)">{{ $t("join") }}</NuxtLink>
    </div>
  </div>
</template>
