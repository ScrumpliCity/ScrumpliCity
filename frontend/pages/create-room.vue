<script setup>
// const { locale } = useI18n();
const localeRoute = useLocaleRoute();

// Values to be used in the room creation form
let sprintCount = ref(0);
let sprintDuration = ref(0);
let roomName = ref("");

let isOpen = ref(true);

const createRoomFunction = () => {
  if (sprintCount.value > 0 && sprintDuration.value > 0) {
    console.log(
      "Room created with " +
        sprintCount.value +
        " sprints of " +
        sprintDuration.value +
        " weeks each.",
    );
  }
};
</script>

<template>
  <div
    class="absolute flex h-screen w-screen items-center justify-center bg-transparent"
  >
    <div
      class="m-6 flex h-2/3 w-3/5 flex-col justify-center rounded-2xl border bg-sc-white drop-shadow-md"
    >
      <div class="grid h-full grid-flow-col-dense grid-cols-2">
        <div class="col-span-2 ml-14 mt-12 flex h-full w-3/5 flex-col gap-10">
          <h1 class="text-center font-heading text-5xl text-sc-orange">
            {{ $t("create_room_heading") }}
          </h1>
          <div
            class="flex flex-col items-center gap-10 [&>*>label]:font-medium"
          >
            <div class="flex flex-col items-center gap-4">
              <label for="room-name" class="text-2xl">{{
                $t("roomname")
              }}</label>
              <!-- TODO: check for uniqueness and profanity -->
              <input
                type="text"
                id="room-name"
                v-model="roomName"
                class="w-80 rounded-lg border p-2 text-center text-2xl drop-shadow-md"
              />
            </div>

            <div class="flex flex-col items-center gap-4">
              <label for="sprints" class="block text-2xl">{{
                $t("sprint_count")
              }}</label>
              <div
                class="flex text-2xl first:rounded-l-md [&>*]:border-collapse [&>*]:border [&>*]:border-sc-black-400 [&>*]:text-sc-black-400"
              >
                <Chooser
                  :choices="[2, 3, 4, 5, 6]"
                  @update:chosen-num="(n) => (sprintCount = n)"
                />
              </div>
            </div>
            <div class="flex flex-col items-center gap-4">
              <label for="sprints" class="block text-2xl">{{
                $t("sprint_duration")
              }}</label>
              <div
                class="flex text-2xl first:rounded-l-md [&>*]:border-collapse [&>*]:border [&>*]:border-sc-black-400 [&>*]:text-sc-black-400"
              >
                <Chooser
                  :choices="[2, 3, 5, 8, 10]"
                  @update:chosen-num="(n) => (sprintDuration = n)"
                />
              </div>
            </div>
          </div>
        </div>
        <div>
          <UButton
            @click="
              isOpen = false;
              navigateTo(localeRoute('rooms', locale));
            "
            class="bg-transparent text-2xl"
          >
            <SvgClose class="absolute right-7 top-7 w-72" />
          </UButton>
          <SvgBackgroundHouses25opacity
            class="absolute bottom-0 right-[60px] w-[349px]"
            :fontControlled="false"
          />
          <UButton
            @click="createRoomFunction"
            class="absolute bottom-6 right-[145px] h-[77px] w-[179px] justify-center rounded-lg bg-sc-black-400 text-2xl text-white hover:bg-sc-black-400"
            :label="useNuxtApp().$i18n.t('create')"
            :class="{
              'bg-sc-green text-sc-black hover:bg-sc-green-400':
                sprintCount > 0 && sprintDuration > 0,
            }"
          />
        </div>
      </div>
    </div>
  </div>
</template>
