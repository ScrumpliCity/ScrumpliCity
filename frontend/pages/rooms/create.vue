<script setup>
// const { locale } = useI18n();
const localeRoute = useLocaleRoute();

// Values to be used in the room creation form
let sprintCount = ref(0);
let buildPhaseDuration = ref(0);
let roomName = ref("");
let meetingDuration = ref(0);

const isOpen = ref(true);

let allSet = computed(() => {
  return (
    roomName.value.trim() !== "" &&
    sprintCount.value > 0 &&
    buildPhaseDuration.value > 0 && meetingDuration.value > 0
  );
});

let totalDuration = computed(() => {
  return sprintCount.value * (buildPhaseDuration.value + 2 * meetingDuration.value); // 2 meetings: Sprint planning and Sprint review
});

const createRoomFunction = () => {
  if (allSet.value) {
    // Dummy code to be replaced with DB call
    console.log(
      "Room created with " +
      sprintCount.value +
      " sprints of " +
      buildPhaseDuration.value +
      " weeks each.",
    );
  }
  navigateTo(localeRoute("rooms"));
};
</script>

<template>
  <UModal v-model="isOpen" prevent-close :ui="{
    width: 'sm:max-w-[55em]',
    height: 'h-[35em]',
    rounded: 'rounded-xl',
    border: 'border',
    shadow: 'drop-shadow-md',
  }">
    <!-- Extra div because class attribute of UModal is not exactly working as it should -->
    <div class="h-full rounded-xl">
      <div class=" mt-12 flex h-full flex-col gap-10">
        <h1 class="ml-16 font-heading text-4xl font-bold text-sc-orange">
          {{ $t("create_room_heading") }}
        </h1>
        <div class="flex gap-36 justify-center mx-40">
          <div class="flex flex-col items-center gap-4">
            <div class="flex flex-col items-center gap-3">
              <label for="room-name" class="text-xl font-bold">{{ $t("roomname") }}</label>
              <input type="text" id="room-name" v-model="roomName"
                class="w-60 rounded-lg border border-sc-black-400 p-2 text-center text-xl drop-shadow-md" />
            </div>

            <div class="flex flex-col items-center gap-3">
              <label for="sprints" class="block text-xl font-medium">{{
                $t("sprint_count")
                }}</label>
              <Chooser :choices="[2, 3, 4, 5, 6]" @update:chosen-num="(n) => (sprintCount = n)" />
            </div>
          </div>
          <div class="flex flex-col items-center gap-4 ">
            <div class="flex flex-col items-center gap-3">
              <label for="sprints" class="block text-xl font-medium">{{
                $t("build_phase_duration")
              }}</label>
              <Chooser :choices="[3, 5, 8, 10, 15]" @update:chosen-num="(n) => (buildPhaseDuration = n)" />
            </div>
            <div class="flex flex-col items-center gap-3">
              <label for="sprints" class="block text-xl font-medium">{{
                $t("meeting_duration")
                }}</label>
              <Chooser :choices="[1, 2, 3, 4, 5]" @update:chosen-num="(n) => (meetingDuration = n)" />
            </div>
            <!-- TODO: once mockup is done add positioning-->
            <strong class="text-xl font-bold">{{ $t('total_duration') }}: {{ totalDuration === 0 ?
              "" :
              totalDuration + " " + $t("minute") + (totalDuration > 1 ? "s" : "") }}</strong> <!-- Adjust i18n for more languages by adding singular and plural forms of word-->
          </div>
        </div>
      </div>
      <div class="flex justify-center">
        <UButton @click="navigateTo(localeRoute('rooms', locale))" class="absolute right-5 top-5 bg-transparent">
          <SvgClose class="w-[2.25em]" :fontControlled="false" filled />
        </UButton>

        <UButton @click="createRoomFunction"
          class="absolute bottom-8 right-12 h-20 w-44 justify-center rounded-lg bg-sc-black-400 text-2xl text-white hover:bg-sc-black-400"
          :class="{
            'bg-sc-green text-sc-black hover:bg-sc-green-400': allSet,
            'pointer-events-none': !allSet,
          }">{{ $t("create") }}</UButton>
      </div>
    </div>
  </UModal>
</template>
