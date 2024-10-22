<script setup>
// Demo für Routing zu lokalen Seiten und Sprachwechsel
const { locale, setLocale } = useI18n();
const localeRoute = useLocaleRoute();

// Demo Data fetching vom Server
const { data } = await useFetch("http://localhost:8000/");
</script>

<template>
  <div>
    <div>
      <button @click="setLocale('de')">de</button>
      <br />
      <button @click="setLocale('en')">en</button>
      <p class="font-heading font-black">{{ $t("welcome") }}</p>
      <NuxtLink :to="localeRoute('join', locale)" class="font-heading font-thin">{{ $t("join") }}</NuxtLink>
      <p>Laravel Version: {{ data.Laravel }}</p>
    </div>
  </div>
</template>
