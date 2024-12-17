<script lang="ts" setup>
definePageMeta({
  middleware: "ensure-playing",
  layout: "in-game",
});

const remainingSeconds = ref(120);

const sprintNameInput = ref("");
const editingSprintName = ref(false);
const showSprintNameInput = computed(
  () => editingSprintName.value || !sprintNameInput.value.trim(),
);

const sprintNameInputField = useTemplateRef("sprintNameInputField");

async function editSprintName() {
  editingSprintName.value = true;
  await nextTick();
  sprintNameInputField.value?.focus();
}

const sprintGoalInput = ref("");
const editingSprintGoal = ref(false);
const showSprintGoalInput = computed(
  () => editingSprintGoal.value || !sprintGoalInput.value.trim(),
);

const intervalId: Ref<ReturnType<typeof setInterval> | undefined> =
  ref(undefined);

onMounted(() => {
  intervalId.value = setInterval(() => {
    remainingSeconds.value = remainingSeconds.value - 1;
  }, 1000);
});

onUnmounted(() => {
  if (intervalId.value !== undefined) clearInterval(intervalId.value);
});

const selected = ref("");
</script>
<template>
  <div class="relative h-full">
    <div class="relative z-10 flex h-full gap-12 pb-16 pl-[4.5rem] pr-12 pt-10">
      <div class="flex flex-[7] flex-col gap-1.5">
        <h1 class="relative flex h-14 gap-3 self-start">
          <span class="font-heading text-5xl font-bold text-sc-orange"
            >Sprint Planning –
            <span
              tabindex="0"
              class="cursor-pointer"
              @click="editSprintName"
              @keydown.enter="editSprintName"
              v-if="!showSprintNameInput"
              >{{ sprintNameInput }}</span
            >
          </span>
          <input
            type="text"
            v-model="sprintNameInput"
            v-if="showSprintNameInput"
            ref="sprintNameInputField"
            @focus="editingSprintName = true"
            @keydown.enter="editingSprintName = false"
            @blur="editingSprintName = false"
            :placeholder="$t('planning.sprint_name')"
            class="block h-14 w-80 rounded-lg border border-sc-black-400 bg-sc-white px-4 py-3 font-sans text-xl font-medium text-black outline-sc-orange drop-shadow-md"
          />
          <InfoPopover
            v-if="showSprintNameInput"
            step="1"
            :text="$t('planning.set_a_sprint_name')"
          />
        </h1>
        <div class="relative self-start">
          <div class="w-[46rem]">
            <input
              v-model="sprintGoalInput"
              ref="sprintGoalInputField"
              icon="octicon:goal-16"
              :placeholder="$t('planning.sprint_goal')"
              class="w-full text-ellipsis rounded-md border-0 bg-transparent px-2.5 py-1.5 ps-9 focus:outline-none focus:ring-2 focus:ring-sc-orange"
              :class="{
                'cursor-pointer': !showSprintGoalInput,
                'shadow-sm ring-1 ring-inset ring-gray-300':
                  showSprintGoalInput,
              }"
              @focus="editingSprintGoal = true"
              @keydown.enter="editingSprintGoal = false"
              @blur="editingSprintGoal = false"
            />
            <span
              class="pointer-events-none absolute inset-0 flex items-center px-2.5"
            >
              <UIcon
                name="octicon:goal-16"
                class="size-5"
                :class="{ 'text-gray-400': showSprintGoalInput }"
              />
            </span>
          </div>

          <InfoPopover
            :text="$t('planning.define_sprint_goal')"
            step="2"
            v-if="showSprintGoalInput"
          />
        </div>
        <div
          class="mt-1.5 flex flex-1 flex-col rounded-2xl border-2 border-sc-black-400 bg-sc-white *:gap-6"
        >
          <div
            class="flex h-11 items-center rounded-t-2xl border-b-2 border-sc-black-400 bg-sc-orange-100 px-4 font-semibold *:w-0 *:basis-0"
          >
            <h3 class="flex-[19]">Titel</h3>
            <h3 class="flex-[51]">Beschreibung</h3>
            <h3 class="flex-[13]">Story Points</h3>
            <h3 class="flex-[12]">Zuständigkeit</h3>
            <div class="flex-[4]">asdf</div>
          </div>
          <div
            class="flex h-14 items-center border-b border-sc-black-400 px-4 *:w-0 *:basis-0"
          >
            <input
              class="block flex-[19] p-2 text-sm ring-1 ring-sc-black-400 focus:outline-none"
            />
            <textarea class="flex-[51]"></textarea>
            <input class="flex-[13]" />
            <USelect
              :options="['United States', 'Canada', 'Mexico']"
              v-model="selected"
              class="flex-[12]"
            />

            <button class="flex-[4]">assdf</button>
          </div>
        </div>
      </div>
      <div class="flex flex-[3] flex-col justify-end">
        <div
          class="flex h-72 flex-col gap-2 rounded-2xl border-2 border-sc-black-400 bg-sc-white p-5"
        >
          <h3 class="text-xl font-semibold">TODO: Teamname</h3>
          <hr class="border-sc-black-300" />
          <p class="text-lg leading-9 *:font-semibold">
            <span>Sprint 1/4</span><br />
            <span>Nächste Phase:</span> TODO
          </p>
          <hr class="border-sc-black-300" />
          <hr class="border-sc-black-300" />
        </div>
      </div>
    </div>
    <Timer
      :total-seconds="120"
      class="absolute right-24 top-0 z-20"
      :remainingSeconds
    ></Timer>
    <SvgMeetingScreenTrees
      :font-controlled="false"
      filled
      class="absolute bottom-0 z-0 h-auto w-[100vw]"
    ></SvgMeetingScreenTrees>
  </div>
</template>
