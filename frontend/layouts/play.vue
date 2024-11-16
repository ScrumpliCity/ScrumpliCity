<script setup lang="ts">
const route = useRoute();
const routeName = computed(() => route.name);

const bus: Ref<any> = useTemplateRef("bus");

const busOffsetVw = computed(() =>
  route.fullPath.startsWith("play__")
    ? -2
    : routeName.value?.toString().startsWith("play-roomcode__")
      ? 13
      : routeName.value?.toString().startsWith("play-roomcode-members__")
        ? 28
        : routeName.value?.toString().startsWith("play-roomcode-ready__")
          ? 43
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
  <div>
    <header>
      <div class="mb-[2.5%] flex w-full place-content-end pr-9 pt-9">
        <ChangeLangButton />
      </div>
    </header>
    <div class="absolute inset-0 -z-10 flex items-end">
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
