<script lang="ts" setup>
import AppHeader from "~/components/AppHeader.vue";

definePageMeta({
  middleware: "ensure-playing",
});

const remainingSeconds = ref(120);

const intervalId: Ref<ReturnType<typeof setInterval> | undefined> =
  ref(undefined);

onMounted(() => {
  intervalId.value = setInterval(() => {
    remainingSeconds.value = remainingSeconds.value - 1;
  }, 1000);
});

onUnmounted(() => {
  if (intervalId.value !== undefined) clearInterval(intervalId.value);
});
</script>
<template>
  <div class="flex flex-col">
    <AppHeader />
    <main class="flex-1 self-end">
      <Timer :total-seconds="120" class="mr-24" :remainingSeconds></Timer>
    </main>
  </div>
</template>
