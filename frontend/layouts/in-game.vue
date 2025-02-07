<script setup lang="ts"></script>
<template>
  <div class="flex h-svh flex-col items-stretch">
    <header
      class="flex h-16 items-center justify-between px-14 shadow-[0px_4px_8px_0px_rgba(0,0,0,0.25)]"
    >
      <NuxtLinkLocale to="/">
        <SvgMainLogo :font-controlled="false" class="h-10" />
      </NuxtLinkLocale>
      <ChangeLangButton></ChangeLangButton>
    </header>
    <div class="flex-1">
      <slot></slot>
    </div>
  </div>
</template>
