<script lang="ts" setup>
import type { Room } from "~/types/api";

definePageMeta({
  middleware: ["sanctum:auth"],
});

const client = useSanctumClient();

const { data, refresh } = await useAsyncData("rooms", () =>
  client("/api/rooms"),
);

const toast = useToast();

import { useI18n } from "vue-i18n";
const { t } = useI18n();

function deleteRoom(room: Room) {
  toast.add({
    icon: "mdi:trash-can-outline",
    title: t("rooms.delete.are_you_sure", { name: room.name }),
    description: " ", // make buttons render on the bottom, not on the ride hand side
    timeout: 0,
    actions: [
      {
        label: t("rooms.delete.delete_forever"),
        variant: "solid",
        color: "red",
        click: async () => {
          try {
            // optimistic update
            data.value = data.value.filter((r: Room) => r.id !== room.id);

            await client(`/api/rooms/${room.id}`, { method: "DELETE" });
            toast.add({
              title: t("rooms.delete.success"),
              icon: "mdi:success",
            });
          } catch {
            toast.add({
              title: t("rooms.delete.error"),
              icon: "material-symbols:error-outline",
            });
          } finally {
            // refresh in any case
            refresh();
          }
        },
      },
    ],
  });
}

const startedRooms = computed(() => {
  return data.value.filter(
    (room: Room) => !room.completed_at && room.last_play_start,
  );
});
const readyRooms = computed(() => {
  return data.value.filter(
    (room: Room) => !room.completed_at && !room.last_play_start,
  );
});
const completedRooms = computed(() => {
  return data.value.filter((room: Room) => room.completed_at);
});
</script>

<template>
  <AppHeader />
  <div class="flex flex-col gap-6 pl-20 pr-14 pt-14">
    <RoomDivider
      iconClass="text-sc-green"
      :text="$t('rooms.started')"
    ></RoomDivider>
    <div class="flex flex-wrap gap-8 pb-4">
      <RoomCard
        v-for="room in startedRooms"
        :key="room.id"
        :room="room"
        @delete="deleteRoom(room)"
      >
      </RoomCard>
    </div>
    <RoomDivider
      iconClass="text-sc-yellow"
      :text="$t('rooms.ready')"
    ></RoomDivider>
    <div class="flex flex-wrap gap-8 pb-4">
      <RoomCard
        v-for="room in readyRooms"
        :key="room.id"
        :room="room"
        @delete="deleteRoom(room)"
      >
      </RoomCard>
    </div>
    <RoomDivider
      iconClass="text-sc-orange"
      :text="$t('rooms.completed')"
    ></RoomDivider>
    <div class="flex flex-wrap gap-8">
      <RoomCard
        v-for="room in completedRooms"
        :key="room.id"
        :room="room"
        @delete="deleteRoom(room)"
      >
      </RoomCard>
    </div>
    {{ data }}
  </div>

  <!-- Slot for room creation popup -->
  <NuxtPage />
</template>
