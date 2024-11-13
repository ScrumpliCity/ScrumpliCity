<script lang="ts" setup>
const props = defineProps({
  title: {
    type: String,
    default: "Info",
  },
  content: {
    type: String,
  },
  progressBar: {
    type: Boolean,
    default: true,
  },
  button: {
    type: String,
    default: "",
  },
});

const isOpen = ref(true);

const progress = computed(() => {
  return 100;
});
</script>

<template>
  <UCard v-if="isOpen" class="fixed bottom-10 right-10 w-[20vw]">
    <h2 class="text-lg font-bold">{{ title }}</h2>

    <p class="text-sm">{{ content }}</p>

    <UButton v-if="button" @click="!isOpen">{{ button }}</UButton>
    <UProgress v-if="progressBar" :value="progress" />
  </UCard>
</template>
