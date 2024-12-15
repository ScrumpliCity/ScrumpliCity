<script setup lang="ts">
const props = defineProps<{
  text: string;
  step?: string;
}>();
</script>

<template>
  <div
    class="absolute left-[calc(100%+0.75rem)] top-1/2 z-10 w-max -translate-y-1/2"
  >
    <div
      class="relative flex items-center gap-1 rounded border border-sc-black-200 bg-sc-white px-2 py-1 shadow-sm before:absolute before:left-0 before:-z-10 before:-translate-x-1/2 before:rotate-45 before:rounded-sm before:bg-sc-black-200 before:p-1.5"
    >
      <span
        v-if="props.step"
        class="inline-flex size-6 items-center justify-center rounded-full bg-sc-orange text-xl font-bold text-sc-white"
        >{{ props.step }}</span
      >{{ props.text }}
    </div>
  </div>
</template>
