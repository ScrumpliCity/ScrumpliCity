<script lang="ts" setup>
const props = defineProps({
  progressBarExists: {
    type: Boolean,
    default: true,
  },
  duration: {
    type: Number,
    default: 5000,
  },
});
const infoboxIsOpen = ref(true);

const progress = reactive({
  value: 0,
});

const toggleInfobox = () => {
  infoboxIsOpen.value = !infoboxIsOpen.value;
};

const startTimer = () => {
  progress.value = 0;
  const interval = setInterval(() => {
    progress.value += 100 / (props.duration / 10);
    if (progress.value >= 100) {
      clearInterval(interval);
      toggleInfobox();
    }
  }, 10);
};

onMounted(() => {
  if (props.progressBarExists) {
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
          <UIcon name="ic:outline-info" class="mr-2 bg-sc-blue" size="5vw" />
          <slot name="title" />
        </div>
        <slot name="content" />
        <div class="flex justify-end">
          <slot name="button" :close="toggleInfobox" />
        </div>
        <UProgress
          v-if="props.progressBarExists"
          :value="progress.value"
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
