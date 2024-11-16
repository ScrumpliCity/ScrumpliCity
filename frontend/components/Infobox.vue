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
  <div>
    <div
      v-if="infoboxIsOpen"
      class="fixed bottom-10 right-10 h-fit max-w-[23vw] rounded-xl border-sc-black-200 bg-sc-blue-light p-4 drop-shadow-sc-shadow"
    >
      <div class="flex items-center">
        <UIcon
          name="ic:outline-info"
          class="mr-2 max-h-[76px] bg-sc-blue"
          size="5vw"
        />
        <slot name="title" />
      </div>
      <slot name="content" />
      <div class="flex justify-end">
        <slot name="button" :close="closeInfobox" />
      </div>
      <slot name="progressBar" />
    </div>
    <div v-else>
      <UButton
        class="fixed bottom-10 right-10 rounded-full bg-sc-blue-light p-0 drop-shadow-sc-shadow hover:bg-sc-blue"
        @click="infoboxIsOpen = true"
      >
        <UIcon
          name="bitcoin-icons:info-filled"
          class="bg-sc-black"
          size="5vw"
        />
      </UButton>
    </div>
  </div>
</template>
