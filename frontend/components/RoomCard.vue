<script lang="ts" setup>
import type { Room } from "~/types/api";

const localeRoute = useLocaleRoute();

const props = defineProps({
  room: {
    type: Object as PropType<Room>,
    required: true,
  },
});

const emit = defineEmits(["delete"]);

const colors = [
  {
    // blue
    background: "#ACBED8",
    houseLeft: "#D3DCEA",
    houseMiddle: "#90A6CA",
    houseRight: "#768CBB",
  },
  {
    // dark green
    background: "#B7B99D",
    houseLeft: "#D3D4C2",
    houseMiddle: "#92956D",
    houseRight: "#81845E",
  },
  {
    // lavender
    background: "#D5CCD1",
    houseLeft: "#E8E2E5",
    houseMiddle: "#BBABB3",
    houseRight: "#A4909A",
  },
  {
    // aqua
    background: "#A5B9BB",
    houseLeft: "#CAD5D7",
    houseMiddle: "#799497",
    houseRight: "#5E797C",
  },
  {
    // rose
    background: "#EFA8B8",
    houseLeft: "#F7D4DC",
    houseMiddle: "#E8849D",
    houseRight: "#DB587C",
  },
  {
    // purple
    background: "#EAB7DE",
    houseLeft: "#F3D7ED",
    houseMiddle: "#DC8AC7",
    houseRight: "#CE66B0",
  },
  {
    // yellow
    background: "#E6BE5E",
    houseLeft: "#EFDA99",
    houseMiddle: "#DCA22E",
    houseRight: "#CD8E25",
  },
  {
    // orange
    background: "#EDBC84",
    houseLeft: "#F4D7B4",
    houseMiddle: "#E49753",
    houseRight: "#DE7C31",
  },
  {
    // light green
    background: "#8CDBA4",
    houseLeft: "#C5EDD1",
    houseMiddle: "#61C780",
    houseRight: "#3CAB5F",
  },
  {
    // grey aka finished
    background: "#B0B0B0", // sc-black-300
    houseLeft: "#D1D1D1", // sc-black-200
    houseMiddle: "#888888", // sc-black-400
    houseRight: "#6D6D6D", // sc-black-500
  },
];

const color = computed(() => {
  if (props.room.completed_at) return colors[9];
  const base32 = "0123456789ABCDEFGHJKMNPQRSTVWXYZ";
  // get the last character of the random part of the ulid and decode it
  const index = base32.indexOf(props.room.id[25]?.toUpperCase() ?? "0");
  return colors[index % 9];
});

const lastPlayedAgoMinutes = computed(() => {
  if (!props.room.last_play_start) return undefined;
  return Math.floor(
    (new Date().getTime() - new Date(props.room.last_play_start).getTime()) /
      1000 /
      60,
  );
});
</script>
<template>
  <button
    @click="
      navigateTo(
        localeRoute({ name: 'rooms-id-manage', params: { id: props.room.id } }),
      )
    "
    class="group flex h-[294px] w-[362px] cursor-pointer flex-col gap-4 rounded-lg bg-sc-black-100 p-7 text-left transition-colors hover:bg-sc-black-200 focus:outline focus:outline-sc-orange"
  >
    <div
      :style="{ 'background-color': color.background }"
      class="relative h-[176px] rounded-t-lg border-b-[3px] border-b-sc-black"
    >
      <div class="relative z-10 p-4">
        <h2 class="text-2xl font-bold">{{ props.room.name }}</h2>
        <p class="text-xl font-bold" v-if="props.room.last_play_start">
          {{ $t("rooms.teams", props.room.team_count) }}
        </p>
      </div>

      <svg
        width="112"
        height="115"
        viewBox="0 0 112 115"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        class="absolute bottom-0 right-7"
      >
        <path d="M0 56.155H47.4666V115H0" :fill="color.houseLeft" />
        <path
          d="M26.7539 56.155V0H77.9368V39.5899H66.3123V115H47.4666V56.2612L26.7539 56.1727V56.155Z"
          :fill="color.houseMiddle"
        />
        <path
          d="M112 39.5723H66.2949V114.982C66.2949 114.982 80.2443 114.982 112 114.982"
          :fill="color.houseRight"
        />
      </svg>
    </div>
    <div class="flex items-center gap-4 pl-3">
      <UTooltip
        :text="$t('rooms.currently_playing')"
        class="flex-none"
        v-if="props.room.is_playing"
      >
        <UIcon
          name="material-symbols:cycle"
          class="size-10 text-sc-green-500 group-hover:animate-[spin_2s_linear_infinite]"
        ></UIcon>
      </UTooltip>
      <div class="flex-1 text-right font-medium leading-5">
        <p>
          {{
            $t("rooms.sprint_display", {
              current_sprint: props.room.current_sprint,
              number_of_sprints: props.room.number_of_sprints,
            })
          }}
        </p>
        <p v-if="props.room.is_playing">
          {{
            $t("rooms.running_for", [
              lastPlayedAgoMinutes! >= 60
                ? `${Math.floor(lastPlayedAgoMinutes! / 60)}h`
                : `${lastPlayedAgoMinutes}min`,
            ])
          }}
        </p>
        <p v-else-if="props.room.completed_at">
          {{
            $t("rooms.completed_on", [
              $d(new Date(props.room.completed_at), "short"),
            ])
          }}
        </p>
        <p v-else-if="props.room.last_play_end">
          {{
            $t("rooms.last_played", [
              $d(new Date(props.room.last_play_end), "short"),
            ])
          }}
        </p>
        <p v-else>
          {{
            $t("rooms.created_on", [
              $d(new Date(props.room.created_at), "short"),
            ])
          }}
        </p>
      </div>
      <UButton
        @click.stop="emit('delete')"
        icon="mdi:trash-can-outline"
        class="size-8 justify-center hover:bg-sc-black-100"
        :padded="false"
        variant="ghost"
        color="sc-orange"
        :ui="{ rounded: 'rounded-full', icon: { size: { sm: 'size-6' } } }"
      >
      </UButton>
    </div>
  </button>
</template>
