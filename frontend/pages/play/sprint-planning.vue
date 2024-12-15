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

const sprintGoalInputField = useTemplateRef("sprintGoalInputField");

async function editSprintGoal() {
  editingSprintGoal.value = true;
  await nextTick();
  sprintGoalInputField.value?.$el.focus();
}

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
            v-if="!sprintNameInput"
            step="1"
            :text="$t('planning.set_a_sprint_name')"
          />
        </h1>
        <div class="relative self-start">
          <UInput
            v-model="sprintGoalInput"
            ref="sprintGoalInputField"
            icon="octicon:goal-16"
            :placeholder="$t('planning.sprint_goal')"
            class="w-[46rem]"
          />
          <InfoPopover :text="$t('planning.define_sprint_goal')" step="2" />
        </div>
        <div class="mt-1.5 flex-1 bg-blue-400"></div>
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
