<script lang="ts" setup>
definePageMeta({
  middleware: ["auth"],
});

const { t } = useI18n();

useSeoMeta({
  title: t("rooms.page_title"),
});

import type { Room } from "~/types/api";

const localePath = useLocalePath();

const client = useSanctumClient();

const route = useRoute();

const { data, refresh } = await useAsyncData("rooms", () =>
  client("/api/rooms"),
);

onMounted(() => {
  // Refresh the rooms list when coming back from the create room page
  watch(
    () => route.path,
    (newPath, oldPath) => {
      if (
        oldPath === localePath("rooms-parent-create") &&
        newPath === localePath("rooms-parent")
      ) {
        refresh();
      }
    },
  );
});

const toast = useToast();

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
  return data.value
    .filter((room: Room) => room.completed_at)
    .toSorted(
      (
        a: Room,
        b: Room, // timestamps are in 2025-03-15 22:27:15 format so they can be ordered alphabetically
      ) => (a.completed_at! > b.completed_at! ? -1 : 1),
    );
});
</script>

<template>
  <AppHeader />
  <div class="relative flex flex-col gap-6 p-14 pl-20">
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
    <div
      class="pointer-events-none fixed bottom-16 right-16 z-10 overflow-hidden pt-44"
    >
      <div class="relative">
        <UButton
          class="peer pointer-events-auto relative z-10 h-20 w-44 items-center justify-center text-4xl font-bold transition-colors hover:bg-sc-orange-700"
          size="xl"
          :to="localePath('rooms-parent-create')"
        >
          {{ $t("rooms.new") }}
        </UButton>

        <svg
          class="absolute left-1/2 top-0 size-40 -translate-x-1/2 transition-transform duration-300 peer-hover:-translate-y-full"
          width="615"
          height="628"
          viewBox="0 0 615 628"
          xmlns="http://www.w3.org/2000/svg"
        >
          <g opacity="0.5">
            <path
              d="M146.908 307.143V0H427.957V216.539H364.126V629H260.643V307.724L146.908 307.24V307.143Z"
              fill="#CE6326"
            />
            <path d="M0 307.144H260.642V629H0" fill="#8CDBA4" />
            <path
              d="M615 216.442H364.029V628.903C364.029 628.903 440.626 628.903 615 628.903"
              fill="#E0AD49"
            />
          </g>
        </svg>
      </div>
    </div>
  </div>
  <NuxtPage />
</template>
