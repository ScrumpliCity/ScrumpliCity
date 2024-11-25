<script lang="ts" setup>
const props = defineProps({
  progressBarExists: {
    type: Boolean,
    default: true,
  },
  duration: {
    type: Number,
    default: 10000,
  },
});
const infoboxIsOpen = ref(true);

const progress = ref(100);

const intervalId = ref();

const toggleInfobox = () => {
  infoboxIsOpen.value = !infoboxIsOpen.value;
  if (intervalId.value) {
    clearInterval(intervalId.value);
    intervalId.value = "";
    progress.value = 100;
  } else if (infoboxIsOpen.value) {
    startTimer();
  }
};

const startTimer = () => {
  progress.value = 100;
  intervalId.value = setInterval(() => {
    progress.value -= 100 / (props.duration / 10);
    if (progress.value <= -1) {
      clearInterval(intervalId.value);
      intervalId.value = "";
      toggleInfobox();
    }
  }, 10);
};

onMounted(() => {
  if (props.progressBarExists && infoboxIsOpen.value) {
    startTimer();
  }
});
</script>

<template>
  <div>
    <transition name="infobox">
      <div
        v-if="infoboxIsOpen"
        class="fixed bottom-10 right-10 h-fit max-w-[23vw] rounded-xl border-sc-black-200 bg-sc-blue-light p-4 drop-shadow-sc-shadow"
      >
        <div class="flex items-center">
          <UIcon name="ic:outline-info" class="mr-2 bg-sc-blue" size="3vw" />
          <slot name="title">
            <h2 class="font-heading text-2xl font-medium text-sc-black-900">
              {{ $t("join_room.infobox.welcome.title") }}
            </h2>
          </slot>
          <div v-if="progressBarExists" class="flex flex-grow justify-end">
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
        <UProgress
          v-if="props.progressBarExists"
          :value="progress"
          color="blue"
        />
      </div>
    </transition>
    <div v-if="!infoboxIsOpen">
      <UButton
        class="fixed bottom-5 right-5 rounded-full bg-sc-blue-light p-0 drop-shadow-sc-shadow hover:bg-sc-blue"
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
