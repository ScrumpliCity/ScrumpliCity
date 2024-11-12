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
  <div class="flex h-full flex-col items-center">
    <h1 class="m-[1%] font-heading text-6xl font-bold text-sc-orange">
      {{ $t("generate-room-code.title") }}
    </h1>
    <p class="text-5xl font-medium">
      {{ $t("generate-room-code.visit") }}
      <b
        ><u>{{ $t("generate-room-code.link") }}</u></b
      >
      {{ $t("generate-room-code.enter-code") }}
    </p>
    <div class="relative flex h-[25%] w-full items-end justify-center">
      <SvgCraneHook
        class="-z-10 h-full w-auto"
        :fontControlled="false"
        filled
      />
      <p class="absolute mb-[1%] text-8xl font-bold">{{ roomcode }}</p>
    </div>
  </div>
</template>
