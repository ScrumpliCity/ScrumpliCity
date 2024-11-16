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
          <slot name="button" :close="closeInfobox" />
        </div>
        <slot name="progressBar" />
      </div>
    </transition>
    <div v-if="!infoboxIsOpen">
      <UButton
        class="fixed bottom-5 right-5 rounded-full bg-sc-blue-light p-0 drop-shadow-sc-shadow hover:bg-sc-blue"
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
