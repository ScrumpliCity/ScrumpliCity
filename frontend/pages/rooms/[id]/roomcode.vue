<script lang="ts" setup>
definePageMeta({
  layout: "generate-roomcode",
});

import type { Room } from "~/types/api";
const client = useSanctumClient();
const route = useRoute();

const { data } = await useAsyncData("rooms", () => client("/api/rooms"));

const manageRoom = data.value.find((room: Room) => room.id === route.params.id);
const roomcode = "789012";
</script>
<template>
  <div class="flex h-full flex-col items-center text-center">
    <h1 class="z-10 m-[1vw] font-heading text-6xl font-bold text-sc-orange">
      {{ $t("generate_room_code.title") }}
    </h1>
    <p class="z-10 text-5xl font-medium">
      {{ $t("generate_room_code.visit") }}
      <b><u>www.scrumplicity.app/play</u></b>
      {{ $t("generate_room_code.enter_code") }}
    </p>
    <div class="relative flex h-[25vw] w-full items-center justify-center">
      <SvgCraneHook class="h-full w-auto" :fontControlled="false" filled />
      <p class="absolute text-7xl font-bold">{{ roomcode }}</p>
    </div>
  </div>
</template>
