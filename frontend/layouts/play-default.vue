<script setup lang="ts">
const route = useRoute();
const routeName = computed(() => route.name);

const { locale, setLocale } = useI18n();

function switchLocale() {
  setLocale(locale.value === "de" ? "en" : "de");
}

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
  <div>
    <header>
      <div class="mb-[4%] flex w-full place-content-end pr-11 pt-11">
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
            <LazySvgI18nEn
              v-else
              :font-controlled="false"
              class="size-14"
              filled
            />
          </template>
        </UButton>
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
