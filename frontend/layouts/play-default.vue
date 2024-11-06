<script setup lang="ts">
const route = useRoute();
const routeName = computed(() => route.name);

const { locale, setLocale } = useI18n();

function switchLocale() {
  setLocale(locale.value === "de" ? "en" : "de");
}

const busMovement = reactive({
  "--bus-start-position": "-282px",
  "--bus-end-position": "2%",
  "--bus-animation-duration": "3s",
});

const defineBusStartEnd = () => {
  switch (true) {
    case routeName.value?.toString().startsWith("play__"):
      busMovement["--bus-start-position"] = "-282px";
      busMovement["--bus-end-position"] = "2%";
      break;
    case routeName.value?.toString().startsWith("play-roomcode__"):
      busMovement["--bus-start-position"] = "2%";
      busMovement["--bus-end-position"] = "8%";
      break;
    // Add more routes here
  }
};

watch(
  routeName,
  () => {
    console.log("Routename:", routeName.value);
    defineBusStartEnd();
  },
  { immediate: true },
);
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
        id="bus"
        class="bus-animation absolute bottom-[6.7%] size-[17%]"
        :fontControlled="false"
        filled
        :style="busMovement"
      />
    </div>
    <slot />
  </div>
</template>

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
  animation: moveBus var(--bus-animation-duration) ease-in-out forwards;
}
</style>
