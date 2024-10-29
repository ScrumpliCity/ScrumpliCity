<script setup>
const localeRoute = useLocaleRoute();
const toast = useToast();
const client = useSanctumClient();

// Room attributes
const sprintCount = ref(0);
const buildPhaseDuration = ref(0);
const roomName = ref("");
const meetingDuration = ref(0);

const loading = ref(false);
const isOpen = ref(true);

const allSet = computed(() => {
  return roomName.value.trim() !== "" && totalDuration.value > 0;
});

const totalDuration = computed(() => {
  // 2 meetings: Sprint planning and Sprint review
  return sprintCount.value > 0 &&
    buildPhaseDuration.value > 0 &&
    meetingDuration.value > 0
    ? sprintCount.value * (buildPhaseDuration.value + 2 * meetingDuration.value)
    : 0;
});

const createRoomFunction = async () => {
  if (!allSet.value) {
    return;
  }

  loading.value = true;
  try {
    const response = await client("/api/rooms", {
      method: "POST",
      body: {
        name: roomName.value,
        number_of_sprints: sprintCount.value,
        sprint_duration: buildPhaseDuration.value + 2 * meetingDuration.value,
        build_phase_duration: buildPhaseDuration.value,
        planning_duration: meetingDuration.value,
        review_duration: meetingDuration.value,
      },
    });
    if (!response) {
      throw new Error("No response from server");
    }

    toast.add({
      title: useNuxtApp().$i18n.t("create_room.room_created"),
      icon: "clarity:success-line",
      variant: "success",
    });
    navigateTo(localeRoute("rooms"));
  } catch (error) {
    toast.add({
      title: useNuxtApp().$i18n.t("create_room.creation_error"),
      icon: "material-symbols:error",
      variant: "error",
    });
  } finally {
    loading.value = false;
  }
};
</script>

<template>
  <UModal
    v-model="isOpen"
    prevent-close
    :ui="{
      width: 'sm:max-w-[55em]',
      height: 'h-[35em]',
      rounded: 'rounded-xl',
      border: 'border',
      shadow: 'drop-shadow-md',
    }"
  >
    <SvgRoomCreation
      class="absolute bottom-16"
      :fontControlled="false"
      filled
    />
    <LoadingSpinner class="z-10 rounded-xl backdrop-blur-md" v-if="loading" />
    <div class="mt-12 flex h-full flex-col gap-10">
      <h1 class="ml-16 font-heading text-4xl font-bold text-sc-orange">
        {{ $t("create_room.heading") }}
      </h1>
      <div class="mx-40 flex justify-center gap-28">
        <div class="flex flex-col items-center gap-3">
          <div class="flex flex-col items-center gap-3">
            <label for="room-name" class="text-lg font-bold">{{
              $t("create_room.room_name")
            }}</label>
            <input
              type="text"
              id="room-name"
              v-model="roomName"
              class="h-10 w-60 rounded-lg border border-sc-black-400 bg-sc-white text-center text-lg drop-shadow-md"
            />
          </div>

          <div class="flex flex-col items-center gap-3">
            <label for="sprints" class="block text-lg font-medium">{{
              $t("create_room.sprint_count")
            }}</label>
            <Chooser
              :choices="[2, 3, 4, 5, 6]"
              @update:chosen-num="(n) => (sprintCount = n)"
              :max="12"
            />
          </div>
        </div>
        <div class="flex flex-col items-center gap-3">
          <div class="flex flex-col items-center gap-3">
            <label for="sprints" class="block text-lg font-medium">{{
              $t("create_room.build_phase_duration")
            }}</label>
            <Chooser
              :choices="[3, 5, 8, 10, 15]"
              @update:chosen-num="(n) => (buildPhaseDuration = n)"
              :max="60"
            />
          </div>

          <div class="flex flex-col items-center gap-3">
            <label for="sprints" class="block text-lg font-medium">{{
              $t("create_room.meeting_duration")
            }}</label>
            <Chooser
              :choices="[1, 2, 3, 4, 5]"
              @update:chosen-num="(n) => (meetingDuration = n)"
              :max="30"
            />
          </div>
          <div
            class="text-md relative left-6 top-[4em] flex h-9 w-56 items-center pl-2"
          >
            <p>{{ $t("create_room.total_duration") }}:</p>
            <span
              class="flex justify-center text-sc-orange"
              v-if="totalDuration > 0"
              >&nbsp;{{
                totalDuration + " " + $t("create_room.minute", totalDuration)
              }}</span
            >
          </div>
        </div>
      </div>
    </div>
    <div class="flex justify-center">
      <button
        @click="navigateTo(localeRoute('rooms', locale))"
        class="absolute right-5 top-5 bg-transparent"
      >
        <SvgClose class="w-[2.25em]" :fontControlled="false" filled />
      </button>

      <UButton
        @click="createRoomFunction"
        class="absolute bottom-8 right-10 h-[2.9em] w-44 justify-center rounded-lg bg-sc-green text-2xl text-sc-black hover:bg-sc-green-400 disabled:pointer-events-none disabled:bg-sc-black-400 disabled:text-white disabled:opacity-100"
        :disabled="!allSet"
        >{{ $t("create_room.create") }}</UButton
      >
    </div>
  </UModal>
</template>
