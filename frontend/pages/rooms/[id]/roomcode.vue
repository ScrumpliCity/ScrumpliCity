<script lang="ts" setup>
definePageMeta({
  layout: "login",
});

import type { Room } from "~/types/api";
const client = useSanctumClient();
const route = useRoute();

const { data } = await useAsyncData("rooms", () => client("/api/rooms"));

const manageRoom = data.value.find((room: Room) => room.id === route.params.id);
const roomcode = "manageRoom.roomcode";
</script>
<template>
  <div>
    <h2>welcome to the room code page</h2>
    <p>Your generated roomcode is: {{ roomcode }}</p>
  </div>
</template>
