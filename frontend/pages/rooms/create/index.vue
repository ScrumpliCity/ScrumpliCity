<script setup>
// const { locale } = useI18n();
const localeRoute = useLocaleRoute();

// Values to be used in the room creation form
let sprintCount = ref(0);
let sprintDuration = ref(0);
let roomName = ref("");

const isOpen = ref(true);

let allSet = computed(() => {
  return (
    roomName.value.trim() !== "" &&
    sprintCount.value > 0 &&
    sprintDuration.value > 0
  );
});

const createRoomFunction = () => {
  if (allSet.value) {
    // Dummy code to be replaced with DB call
    console.log(
      "Room created with " +
        sprintCount.value +
        " sprints of " +
        sprintDuration.value +
        " weeks each.",
    );
  }
  navigateTo(localeRoute("rooms"));
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
    <!-- Extra div because class attribute of UModal is not exactly working as it should -->
    <div class="grid h-full grid-flow-col-dense grid-cols-2 gap-8 rounded-xl">
      <div class="ml-7 mt-12 flex h-full flex-col gap-10">
        <h1 class="text-center font-heading text-4xl font-bold text-sc-orange">
          {{ $t("create_room_heading") }}
        </h1>
        <div class="flex flex-col items-center gap-10 [&>*>label]:font-medium">
          <div class="flex flex-col items-center gap-3">
            <label for="room-name" class="text-xl">{{ $t("roomname") }}</label>
            <input
              type="text"
              id="room-name"
              v-model="roomName"
              class="w-60 rounded-lg border border-sc-black-400 p-2 text-center text-xl drop-shadow-md"
            />
          </div>

          <div class="flex flex-col items-center gap-3">
            <label for="sprints" class="block text-xl">{{
              $t("sprint_count")
            }}</label>
            <div
              class="flex text-xl first:rounded-l-md [&>*]:border-collapse [&>*]:border [&>*]:border-sc-black-400 [&>*]:text-sc-black-400"
            >
              <Chooser
                :choices="[2, 3, 4, 5, 6]"
                @update:chosen-num="(n) => (sprintCount = n)"
              />
            </div>
          </div>
          <div class="flex flex-col items-center gap-3">
            <label for="sprints" class="block text-xl">{{
              $t("sprint_duration")
            }}</label>
            <div
              class="flex text-xl first:rounded-l-md [&>*]:border-collapse [&>*]:border [&>*]:border-sc-black-400 [&>*]:text-sc-black-400"
            >
              <Chooser
                :choices="[2, 3, 5, 8, 10]"
                @update:chosen-num="(n) => (sprintDuration = n)"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="flex justify-center">
        <UButton
          @click="navigateTo(localeRoute('rooms', locale))"
          class="absolute right-5 top-5 bg-transparent"
        >
          <SvgClose class="w-[2.25em]" :fontControlled="false" filled />
        </UButton>
        <SvgBackgroundHouses25opacity
          class="absolute bottom-0 right-[3em] z-0 w-[18em]"
          :fontControlled="false"
          filled
        />
        <UButton
          @click="createRoomFunction"
          class="absolute bottom-6 right-[4.75em] h-[77px] w-[7em] justify-center rounded-lg bg-sc-black-400 text-2xl text-white hover:bg-sc-black-400"
          :class="{
            'bg-sc-green text-sc-black hover:bg-sc-green-400': allSet,
            'pointer-events-none': !allSet,
          }"
          >{{ $t("create") }}</UButton
        >
      </div>
    </div>
  </UModal>
</template>
