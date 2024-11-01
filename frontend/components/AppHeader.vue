<script lang="ts" setup>
const { locale, setLocale } = useI18n();

function switchLocale() {
  setLocale(locale.value === "de" ? "en" : "de");
}
</script>

<template>
  <header
    class="sticky top-0 z-50 flex h-28 w-full items-center bg-sc-white px-14 shadow-[0px_4px_8px_0px_rgba(0,0,0,0.25)]"
  >
    <NuxtLinkLocale to="/">
      <SvgMainLogo :font-controlled="false" class="h-12" />
    </NuxtLinkLocale>
    <div class="flex-1"></div>
    <div class="flex items-center gap-4">
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
            class="size-12"
            filled
          />
          <LazySvgI18nEn
            v-else
            :font-controlled="false"
            class="size-12"
            filled
          />
        </template>
      </UButton>
      <UButton
        icon="mdi:file-download-outline"
        class="hover:bg-sc-black-100"
        variant="ghost"
        color="black"
        :padded="true"
        :ui="{ rounded: 'rounded-full', icon: { size: { sm: 'size-10' } } }"
      ></UButton>
      <!-- Random image till we have an actual image -->
      <img
        class="size-10 rounded-full bg-slate-300"
        src="https://picsum.photos/40/40"
      />
    </div>
  </header>
</template>
