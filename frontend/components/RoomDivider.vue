<script lang="ts" setup>
const props = defineProps({
  text: {
    type: String,
    required: true,
  },
  iconClass: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <div class="flex items-center gap-6 pl-2">
    <SvgStatusArrow
      class="size-10 flex-none"
      :class="props.iconClass"
      filled
      :fontControlled="false"
    />
    <h1 class="flex-none font-heading text-4xl">{{ props.text }}</h1>
    <UDivider
      size="2xs"
      class="flex-1"
      :ui="{ border: { base: 'border-sc-black-400' } }"
    ></UDivider>
  </div>
</template>
