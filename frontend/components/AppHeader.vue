<script lang="ts" setup></script>

<template>
  <header
    class="sticky top-0 z-50 flex h-28 w-full items-center bg-sc-white px-14 shadow-[0px_4px_8px_0px_rgba(0,0,0,0.25)]"
  >
    <NuxtLinkLocale to="/">
      <SvgMainLogo :font-controlled="false" class="h-12" />
    </NuxtLinkLocale>
    <div class="flex-1"></div>
    <div class="flex items-center gap-4">
      <ChangeLangButton />
      <UButton
        class="hover:bg-sc-black-100"
        variant="ghost"
        color="black"
        :padded="true"
        :ui="{
          padding: { sm: 'p-[0.15em]' },
          rounded: 'rounded-full',
        }"
      >
        <SvgDownload :font-controlled="false" class="h-14 w-14" />
      </UButton>
      <!-- Random image till we have an actual image -->
      <img
        class="size-10 rounded-full bg-slate-300"
        src="https://picsum.photos/40/40"
      />
    </div>
  </header>
</template>
