<script setup lang="ts">
const { locale, setLocale } = useI18n();

function switchLocale() {
  setLocale(locale.value === "de" ? "en" : "de");
}
</script>

<template>
  <UButton
    @click="switchLocale()"
    :padded="false"
    variant="ghost"
    class="hover:bg-transparent"
  >
    <template #leading>
      <LazySvgI18nDe
        v-if="locale === 'de'"
        :font-controlled="false"
        class="size-14"
        filled
      />
      <LazySvgI18nEn v-else :font-controlled="false" class="size-14" filled />
    </template>
  </UButton>
</template>
