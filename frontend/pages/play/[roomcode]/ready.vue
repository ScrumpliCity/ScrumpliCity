<script setup>
definePageMeta({
  layout: "play",
});

const route = useRoute();

// @TODO: fetch from backend
const teamMembers = ref([
  { id: 1, name: "Max Mustermann", role: "Developer" },
  { id: 2, name: "Erika Mustermann", role: "Scrum Master" },
  { id: 3, name: "Hans Mustermann", role: "Product Owner" },
  { id: 4, name: "Anna Schmidt", role: "Developer" },
  { id: 5, name: "John Doe", role: "Developer" },
  { id: 6, name: "Jane Doe", role: "Developer" },
]);
const sprintCount = ref(5);
const sprintDuration = ref(10);
const meetingDuration = ref(5);
const roomCode = ref(route.params.roomcode);
const teamName = ref("Scrumplicity Team");
</script>

<template>
  <Teleport to="#teleports">
    <div class="absolute left-11 top-11 text-3xl">
      <span class="font-heading font-bold text-sc-black">{{ roomCode }}/</span>
      <span class="font-heading font-bold text-sc-orange">{{ teamName }} </span>
    </div>
  </Teleport>
  <div class="mr-[14.5vw] flex flex-col items-center gap-12">
    <h1 class="font-heading text-5xl font-bold text-sc-orange">
      {{ $t("join_room.ready.waiting_for_start") }}
    </h1>
    <div class="flex items-start gap-20">
      <div
        class="flex max-h-[50vh] min-w-[32.5vw] flex-col gap-2 rounded-xl border border-sc-black-400 bg-sc-white px-9 pb-8 pt-3 drop-shadow-sc-shadow"
      >
        <h2 class="self-center font-heading text-3xl font-bold text-sc-orange">
          {{ $t("join_room.ready.team_members") }}
        </h2>
        <div class="overflow-y-auto">
          <ul class="list-none divide-y divide-sc-black text-2xl text-gray-600">
            <li v-for="member in teamMembers" :key="member.id" class="py-4">
              <strong class="font-semibold text-gray-800"
                >{{ member.name }}:
              </strong>
              {{ member.role }}
            </li>
          </ul>
        </div>
      </div>
      <div
        class="flex min-w-[25vw] flex-col gap-2 rounded-xl border border-sc-black-400 bg-sc-white px-9 pb-5 pt-3 drop-shadow-sc-shadow"
      >
        <h2 class="self-center font-heading text-3xl font-bold text-sc-orange">
          {{ $t("join_room.ready.room_settings") }}
        </h2>
        <div>
          <ul
            class="list-none divide-y divide-sc-black text-2xl text-gray-600 *:py-4"
          >
            <li>
              <strong class="font-semibold text-gray-800"
                >{{ $t("join_room.ready.sprint_count") }}:
              </strong>
              {{ sprintCount }}
            </li>
            <li>
              <strong class="font-semibold text-gray-800"
                >{{ $t("join_room.ready.sprint_duration") }}:
              </strong>
              {{ sprintDuration }} {{ $t("join_room.ready.minutes") }}
            </li>
            <li>
              <strong class="font-semibold text-gray-800"
                >{{ $t("join_room.ready.meeting_duration") }}:
              </strong>
              {{ meetingDuration }} {{ $t("join_room.ready.minutes") }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
