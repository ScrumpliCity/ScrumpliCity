<template>
  <div>
    <header>Play Default Layout</header>
    <div class="absolute inset-0 -z-10 flex items-end">
      <SvgJoinRoomBgTreesHouses
        class="w-screen"
        :fontControlled="false"
        filled
      />
      <SvgJoinRoomBgBus
        id="bus"
        class="bus-animation absolute bottom-[6.7%] w-[282px]"
        :fontControlled="false"
        filled
      />
    </div>
    <slot />
  </div>
</template>

<script lang="ts"></script>

<style scoped>
@keyframes moveBus {
  from {
    left: var(--bus-start-position);
  }
  to {
    left: var(--bus-end-position);
  }
}

.bus-animation {
  animation: moveBus var(--bus-animation-duration) linear forwards;
}
</style>
