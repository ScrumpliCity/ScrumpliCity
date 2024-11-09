<script setup lang="ts"></script>

<template>
  <div class="flex h-screen flex-col">
    <header class="flex w-full items-center justify-between p-7">
      <NuxtLinkLocale to="/">
        <SvgMainLogo :font-controlled="false" class="h-12" />
      </NuxtLinkLocale>
      <ChangeLangButton />
    </header>
    <div class="absolute inset-0 -z-10 flex items-end">
      <SvgJoinRoomBgTreesHouses
        class="w-screen"
        :fontControlled="false"
        filled
      />
      <SvgJoinRoomBgBus
        class="absolute bottom-[3.1vw] left-[10vw] h-[8.5vw] transition-transform duration-1000"
        :fontControlled="false"
        filled
      />
    </div>
    <div class="flex-grow">
      <slot />
    </div>
  </div>
</template>
