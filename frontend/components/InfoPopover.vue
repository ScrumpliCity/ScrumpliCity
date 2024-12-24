<script setup lang="ts">
const {
  text,
  step,
  position = "right",
} = defineProps<{
  text: string;
  step?: string;
  position?: "left" | "right";
}>();
const isLeft = computed(() => position === "left");
</script>

<template>
  <div
    class="pointer-events-none absolute top-1/2 z-10 w-max -translate-y-1/2 font-sans text-base font-normal"
    :class="isLeft ? 'right-[calc(100%+0.75rem)]' : 'left-[calc(100%+0.75rem)]'"
  >
    <div
      class="relative flex items-center gap-1 rounded border border-sc-black-200 bg-sc-white px-2 py-1 shadow-sm before:absolute before:-z-10 before:rotate-45 before:rounded-sm before:bg-sc-black-200 before:p-1.5"
      :class="
        isLeft
          ? 'before:right-0 before:translate-x-1/2'
          : 'before:left-0 before:-translate-x-1/2'
      "
    >
      <span
        v-if="step"
        class="inline-flex size-6 items-center justify-center rounded-full bg-sc-orange text-xl font-bold text-sc-white"
        >{{ step }}</span
      >{{ text }}
    </div>
  </div>
</template>
