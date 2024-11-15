<script lang="ts" setup>
const infoboxIsOpen = ref(true);

const progress = computed(() => {
  return 100;
});

const closeInfobox = () => {
  infoboxIsOpen.value = false;
};
</script>

<template>
  <div
    v-if="infoboxIsOpen"
    class="fixed bottom-10 right-10 h-fit max-w-[23vw] rounded-xl border-sc-black-200 bg-[#DCE9FE] p-4 drop-shadow-sc-shadow"
  >
    <div class="flex items-center">
      <UIcon name="ic:outline-info" class="mr-2 bg-[#2B7FFF]" size="5vw" />
      <slot name="title" />
    </div>
    <slot name="content" />
    <div class="flex justify-end">
      <slot name="button" :close="closeInfobox" />
    </div>
    <slot name="progressBar" />
  </div>
</template>
