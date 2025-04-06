<script setup lang="ts">
const { locale, setLocale } = useI18n();
let holdTimer: ReturnType<typeof setTimeout> | null = null;
const longPressTriggered = ref(false);

function switchLocale() {
  if (longPressTriggered.value) {
    longPressTriggered.value = false;
    return;
  }
  setLocale(locale.value === "de" ? "en" : "de");
}

function startTimer() {
  holdTimer = setTimeout(() => {
    longPressTriggered.value = true;
    setLocale("vie");
    console.log(locale.value);
  }, 3000);
}

function clearTimer() {
  if (holdTimer) {
    clearTimeout(holdTimer);
    holdTimer = null;
  }
}
</script>

<template>
  <UButton
    @click="switchLocale()"
    @mousedown="startTimer"
    @mouseup="clearTimer"
    @mouseleave="clearTimer"
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
        @mouseover="prefetchComponents('SvgI18nEn')"
      />
      <LazySvgI18nVie
        v-else-if="locale === 'vie'"
        :font-controlled="false"
        class="size-14"
        filled
        @mouseover="prefetchComponents('SvgI18nEn')"
      />
      <!-- prefetching Components to avoid flashing on the first click -->
      <LazySvgI18nEn
        v-else
        :font-controlled="false"
        class="size-14"
        filled
        @mouseover="prefetchComponents('SvgI18nDe')"
      />
    </template>
  </UButton>
</template>
