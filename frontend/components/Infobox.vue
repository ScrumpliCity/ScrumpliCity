<script lang="ts" setup>
const props = defineProps({
  withTimeout: {
    type: Boolean,
    default: true,
  },
  durationInS: {
    type: Number,
    default: 10,
  },
});
const infoboxIsOpen = ref(true);

const duration = ref(props.durationInS);

const intervalId = ref();

const toggleInfobox = () => {
  infoboxIsOpen.value = !infoboxIsOpen.value;
  if (intervalId.value) {
    clearInterval(intervalId.value);
    intervalId.value = "";
    duration.value = props.durationInS;
  } else if (infoboxIsOpen.value) {
    startTimer();
  }
};

const startTimer = () => {
  duration.value = props.durationInS;
  intervalId.value = setInterval(() => {
    duration.value -= 1;
    if (duration.value <= 0) {
      clearInterval(intervalId.value);
      intervalId.value = "";
      toggleInfobox();
    }
  }, 1000);
};

onMounted(() => {
  if (props.withTimeout && infoboxIsOpen.value) {
    startTimer();
  }
});
</script>

<template>
  <div>
    <transition name="infobox">
      <div
        v-if="infoboxIsOpen"
        class="fixed bottom-10 right-10 h-fit max-w-[23vw] rounded-xl border-sc-black-200 bg-sc-blue-background p-4 drop-shadow-sc-shadow"
      >
        <div class="flex items-center">
          <UIcon name="ic:outline-info" class="mr-2 bg-sc-blue" size="3vw" />
          <slot name="title">
            <h2 class="font-heading text-2xl font-medium text-sc-black-900">
              {{ $t("join_room.infobox.welcome.title") }}
            </h2>
          </slot>
          <div v-if="withTimeout" class="flex flex-grow justify-end">
            <button @click="toggleInfobox" class="bg-transparent">
              <SvgClose class="w-5" :fontControlled="false" filled />
            </button>
          </div>
        </div>
        <slot name="content">
          <p class="my-2 text-sc-black-500">
            {{ $t("join_room.infobox.welcome.content") }}
          </p>
        </slot>
        <div class="flex justify-end">
          <slot name="button" :close="toggleInfobox" />
        </div>
      </div>
    </transition>
    <div v-if="!infoboxIsOpen">
      <UButton
        class="fixed bottom-5 right-5 rounded-full bg-sc-blue-background p-0 drop-shadow-sc-shadow hover:bg-sc-blue"
        @click="toggleInfobox"
      >
        <UIcon
          name="material-symbols-light:info-i"
          class="bg-sc-black"
          size="4.5vw"
        />
      </UButton>
    </div>
  </div>
</template>
<style scoped>
.infobox-enter-active,
.infobox-leave-active {
  transition:
    transform 0.5s,
    opacity 0.5s;
}

.infobox-enter-from,
.infobox-leave-to {
  transform: scale(0);
  opacity: 0.5;
  transform-origin: bottom right;
}

.infobox-enter-to,
.infobox-leave-from {
  transform: scale(1);
  opacity: 1;
  transform-origin: bottom right;
}
</style>
