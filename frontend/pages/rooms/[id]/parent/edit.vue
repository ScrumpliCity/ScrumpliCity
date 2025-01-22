<script setup>
const localePath = useLocalePath();
const toast = useToast();
const client = useSanctumClient();
const route = useRoute();

const { data } = await useAsyncData("rooms", () => client("/api/rooms"));
const manageRoom = data.value.find((room) => room.id === route.params.id);
</script>

<template>
  <RoomManager
    :sprintCount="manageRoom.number_of_sprints"
    :buildPhaseDuration="manageRoom.build_phase_duration"
    :roomName="manageRoom.name"
    :meetingDuration="manageRoom.planning_duration"
    type="edit"
    :room-id="manageRoom.id"
    :routeToParent="
      localePath({
        name: 'rooms-id-parent',
        params: { id: manageRoom.id },
      })
    "
  />
</template>
