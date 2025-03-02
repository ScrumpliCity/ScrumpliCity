<script setup>
definePageMeta({
  layout: "play",
  middleware: "ensure-playing",
});

const { t } = useI18n();
const localeRoute = useLocaleRoute();

useSeoMeta({
  title: t("join_room.ready.page_title"),
});

const game = useGameStore();

const { data: teamMembers } = await useAsyncData("teamMembers", () =>
  game.getMembers(),
);

onMounted(() => {
  const echo = useEcho();
  //TODO: navigate to roomcode input page
  echo
    .channel(`rooms.${game.team.room_id}`)
    .listen("TeamsDeactivated", () => navigateTo(localeRoute("play")))
    .error((e) => {
      console.error("Channel error:", e);
    });
});
</script>

<template>
  <Teleport to="#teleports">
    <div class="absolute left-11 top-11 text-3xl">
      <span class="font-heading font-bold text-sc-black"
        >{{ game.team.room.roomcode }}/</span
      >
      <span class="font-heading font-bold text-sc-orange"
        >{{ game.team.name }}
      </span>
    </div>
  </Teleport>
  <div class="mr-[14.5vw] flex flex-col items-center gap-12">
    <h1 class="font-heading text-5xl font-bold text-sc-orange">
      {{ $t("join_room.ready.waiting_for_start") }}
      <span
        class="animate-pulse [animation-delay:-0.5s] [animation-duration:1.4s]"
        >.</span
      >
      <span
        class="animate-pulse [animation-delay:-0.25s] [animation-duration:1.4s]"
        >.</span
      >
      <span class="animate-pulse [animation-duration:1.4s]">.</span>
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
              {{ game.team.room.number_of_sprints }}
            </li>
            <li>
              <strong class="font-semibold text-gray-800"
                >{{ $t("join_room.ready.sprint_duration") }}:
              </strong>
              {{ game.team.room.sprint_duration }}
              {{ $t("join_room.ready.minutes") }}
            </li>
            <li>
              <strong class="font-semibold text-gray-800"
                >{{ $t("join_room.ready.planning_duration") }}:
              </strong>
              {{ game.team.room.planning_duration }}
              {{ $t("join_room.ready.minutes") }}
            </li>
            <li>
              <strong class="font-semibold text-gray-800"
                >{{ $t("join_room.ready.review_duration") }}:
              </strong>
              {{ game.team.room.review_duration }}
              {{ $t("join_room.ready.minutes") }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
