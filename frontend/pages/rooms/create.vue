<script setup>
const localeRoute = useLocaleRoute();

// Values to be used in the room creation form
let sprintCount = ref(0);
let buildPhaseDuration = ref(0);
let roomName = ref("");
let meetingDuration = ref(0);
let loading = ref(false);
let toast = useToast();
const isOpen = ref(true);


let allSet = computed(() => {
  return (
    roomName.value.trim() !== "" && totalDuration.value > 0
  );
});

let totalDuration = computed(() => {
  // 2 meetings: Sprint planning and Sprint review
  return sprintCount.value > 0 &&
    buildPhaseDuration.value > 0 &&
    meetingDuration.value > 0 ?
    sprintCount.value *
    (buildPhaseDuration.value + 2 * meetingDuration.value)
    : 0;
});

const createRoomFunction = async () => {
  if (allSet.value) {
    // TODO: Inform user that room creation was successful in /rooms (toast)

    loading.value = true;

    try {
      const response = await useApiFetch("rooms", {
        method: "POST",
        body: {
          name: roomName.value,
          number_of_sprints: sprintCount.value,
          sprint_duration: (buildPhaseDuration.value + 2 * meetingDuration.value),
          build_phase_duration: buildPhaseDuration.value,
          planning_duration: meetingDuration.value,
          review_duration: meetingDuration.value
        }
      });
      if (!response) {
        throw new Error("No response from server");
      }

      // Should be handled in room overview
      // toast.add({
      //   title: useNuxtApp().$i18n.t("room_created"),
      //   icon: "clarity:success-line",
      //   variant: "success",
      //   timeout: 1000
      // });
      navigateTo(localeRoute("rooms"));
    } catch (error) {
      console.log(error);

      // Fehlerbehandlung
      toast.add({
        title: useNuxtApp().$i18n.t("room_creation_error"),
        icon: "material-symbols:error",
        variant: "error",
      });
    } finally {
      loading.value = false;
    }
  }
};
</script>

<template>
  <UModal v-model="isOpen" prevent-close :ui="{
    width: 'sm:max-w-[55em]',
    height: 'h-[35em]',
    rounded: 'rounded-xl',
    border: 'border',
    shadow: 'drop-shadow-md'
  }">
    <SvgGrafikRaumerstellung class="absolute bottom-16" :fontControlled="false" filled />
    <LoadingSpinner class="backdrop-blur-md rounded-xl z-10" v-if="loading" />
    <div class="mt-12 flex h-full flex-col gap-10">

      <h1 class="ml-16 font-heading text-4xl font-bold text-sc-orange">
        {{ $t("create_room_heading") }}
      </h1>
      <div class="flex gap-28 justify-center mx-40">
        <div class="flex flex-col items-center gap-3">
          <div class="flex flex-col items-center gap-3">
            <label for="room-name" class="text-lg font-bold">{{ $t("roomname") }}</label>
            <input type="text" id="room-name" v-model="roomName"
              class="w-60 rounded-lg border border-sc-black-400 bg-sc-white h-10 text-center text-lg drop-shadow-md" />
          </div>

          <div class="flex flex-col items-center gap-3">
            <label for="sprints" class="block text-lg font-medium">{{
              $t("sprint_count")
              }}</label>
            <Chooser :choices="[2, 3, 4, 5, 6]" @update:chosen-num="(n) => (sprintCount = n)" :max="12"/>
          </div>
        </div>
        <div class="flex flex-col items-center gap-3 ">
          <div class="flex flex-col items-center gap-3">
            <label for="sprints" class="block text-lg font-medium">{{
              $t("build_phase_duration")
              }}</label>
            <Chooser :choices="[3, 5, 8, 10, 15]" @update:chosen-num="(n) => (buildPhaseDuration = n)" :max="60" />
          </div>

          <div class="flex flex-col items-center gap-3">
            <label for="sprints" class="block text-lg font-medium">{{
              $t("meeting_duration")
              }}</label>
            <Chooser :choices="[1, 2, 3, 4, 5]" @update:chosen-num="(n) => (meetingDuration = n)" :max="30"/>
          </div>
          <div class="relative top-[4em] left-6 w-56 h-9 pl-2 text-md  flex items-center">
            <p>{{ $t('total_duration') }}:</p>
            <span class="text-sc-orange flex justify-center" v-if="totalDuration > 0">&nbsp;{{ totalDuration + " " +  $t("minute", totalDuration)  }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="flex justify-center">
      <button @click="navigateTo(localeRoute('rooms', locale))" class="absolute right-5 top-5 bg-transparent">
        <SvgClose class="w-[2.25em]" :fontControlled="false" filled />
      </button>

      <UButton @click="createRoomFunction"
        class="absolute bottom-8 right-10 h-[2.9em] w-44 justify-center rounded-lg bg-sc-black-400 text-2xl text-white hover:bg-sc-black-400"
        :class="{
          'bg-sc-green text-sc-black hover:bg-sc-green-400': allSet,
          'pointer-events-none': !allSet,
        }">{{ $t("create") }}</UButton>
    </div>
    <UNotifications />
  </UModal>
</template>
