<script setup lang="ts"></script>

<template>
  <div class="flex h-screen flex-col">
    <header class="flex w-full items-center justify-end p-7">
      <ChangeLangButton />
    </header>
    <div class="absolute inset-0 -z-10 flex items-end">
      <SvgJoinRoomBgTreesHouses
        class="w-screen"
        :fontControlled="false"
        filled
      />
      <SvgJoinRoomBgBus
        class="animate-drive absolute bottom-[3.1vw] h-[8.5vw] transition-transform duration-1000"
        :fontControlled="false"
        filled
      />
    </div>
    <div class="flex-grow">
      <slot />
    </div>
  </div>
</template>
<style scoped>
@keyframes drive {
  0% {
    transform: translateX(-100%);
  }
  100% {
    transform: translateX(100vw);
  }
}

.animate-drive {
  animation: drive 30s linear infinite;
}
</style>
