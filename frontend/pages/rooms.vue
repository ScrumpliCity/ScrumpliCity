<script lang="ts" setup>
const roomCreationIsOpen = ref(false);
</script>

<template>
  <AppHeader />
  <!-- Slot for room creation popup -->
  <NuxtPage page-key="create-room" v-if="roomCreationIsOpen" />
  <UButton
    @click="
      roomCreationIsOpen = true;
      console.log(roomCreationIsOpen);
    "
    >Raum erstellen</UButton
  >
  <!-- <NuxtPage /> -->
</template>
