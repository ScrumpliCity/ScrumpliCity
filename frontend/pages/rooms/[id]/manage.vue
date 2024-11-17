<script lang="ts" setup>
import type { Room } from "~/types/api";
const client = useSanctumClient();
const localeRoute = useLocaleRoute();
const route = useRoute();

const { data } = await useAsyncData("rooms", () => client("/api/rooms"));

// TODO: handle non-existence of room
const manageRoom = data.value.find((room: Room) => room.id === route.params.id);
</script>
<template>
  <div>
    <h2>welcome to the manage page</h2>
    <p>Room id: {{ manageRoom.id }}</p>
    <UButton
      @click="
        navigateTo(
          localeRoute({
            name: 'rooms-id-roomcode',
            params: { id: manageRoom.id },
          }),
        )
      "
      >{{ $t("generate_room_code.generate_code") }}</UButton
    >
  </div>
</template>
