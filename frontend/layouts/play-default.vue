<script setup lang="ts">
const route = useRoute();
const routeName = computed(() => route.name);

const bus: Ref<any> = useTemplateRef("bus");

const busOffsetVw = computed(() =>
  route.fullPath.startsWith("play__")
    ? -2
    : routeName.value?.toString().startsWith("play-roomcode__")
      ? 12
      : -2,
);

onMounted(() => {
  watch(
    busOffsetVw,
    () => {
      bus.value.$el.style.setProperty(
        "--bus-translate-x",
        `${busOffsetVw.value}vw`,
      );
    },
    { immediate: true },
  );
});
</script>

<template>
  <div class="flex h-screen flex-col">
    <header class="z-10 mb-[4%] flex w-full justify-end pr-11 pt-11">
      <ChangeLangButton />
    </header>
    <div class="absolute inset-0 flex items-end">
      <SvgJoinRoomBgTreesHouses
        class="w-screen"
        :fontControlled="false"
        filled
      />
      <SvgJoinRoomBgBus
        class="absolute bottom-[3.1vw] h-[8.5vw] translate-x-[var(--bus-translate-x,-15vw)] transition-transform duration-1000"
        :fontControlled="false"
        filled
        ref="bus"
      />
    </div>
    <slot />
  </div>
</template>
