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
            >{{ $t("planning.sprint_planning") }} –
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
                'shadow-sm ring-1 ring-inset ring-sc-black-400':
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
          class="relative mt-1.5 flex-1 overflow-clip rounded-2xl border-2 border-sc-black-400 bg-sc-white"
        >
          <table class="w-full table-fixed divide-y-2 divide-sc-black-400">
            <thead>
              <tr
                class="h-11 rounded-t-2xl bg-sc-orange-100 px-2 font-semibold"
              >
                <th class="p-2 px-4 text-left">{{ $t("planning.title") }}</th>
                <th class="p-2 text-left">{{ $t("planning.description") }}</th>
                <th class="w-28">{{ $t("planning.story_points") }}</th>
                <th>{{ $t("planning.responsible") }}</th>
                <th class="w-14"></th>
              </tr>
            </thead>
            <tbody class="divide-y">
              <template v-for="_ in Array(5)">
                <tr class="h-14 border-b border-sc-black-400">
                  <td class="p-2">
                    <input
                      class="rounded-lg bg-sc-white bg-transparent p-2 text-sm ring-inset focus:outline-none focus:ring-2 focus:ring-sc-orange [&:is(:placeholder-shown,:focus-within)]:shadow [&:is(:placeholder-shown,:focus-within)]:ring-1 [&:is(:placeholder-shown,:focus-within)]:ring-sc-black-400 [&:not(:placeholder-shown,:focus-within)]:cursor-pointer"
                      placeholder="Titel der US"
                    />
                  </td>
                  <td>
                    <textarea class="p-2"></textarea>
                  </td>
                  <td class="text-center">
                    <input
                      class="size-7 rounded-full bg-sc-black-100 text-center text-lg font-semibold text-sc-black placeholder:text-sc-black focus:outline-none focus:ring-2 focus:ring-sc-orange [&:not(:placeholder-shown,:focus-within)]:cursor-pointer"
                      type="number"
                      placeholder="_"
                    />
                  </td>
                  <td>
                    <USelect
                      :options="['United States', 'Canada', 'Mexico']"
                      v-model="selected"
                    />
                  </td>
                  <td class="p-2">
                    <UButton
                      icon="mdi:trash-can-outline"
                      class="size-10 justify-center transition-colors hover:bg-sc-black-100"
                      :padded="false"
                      variant="ghost"
                      color="sc-orange"
                      :ui="{
                        rounded: 'rounded-full',
                        icon: { size: { sm: 'size-6' } },
                      }"
                    >
                    </UButton>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
          <button
            class="absolute bottom-4 right-4 flex size-8 justify-center rounded-lg bg-sc-orange text-3xl font-bold transition-colors hover:bg-sc-orange-700"
          >
            <UIcon name="ic:round-plus" class="size-8" />
            <InfoPopover
              v-if="true"
              step="3"
              position="left"
              :text="$t('planning.write_user_story')"
            ></InfoPopover>
          </button>
        </div>
      </div>
      <div class="flex flex-[3] flex-col justify-end">
        <div
          class="flex h-72 flex-col gap-2 rounded-2xl border-2 border-sc-black-400 bg-sc-white p-5"
        >
          <h3 class="text-xl font-semibold">{Teamname}</h3>
          <hr class="border-sc-black-300" />
          <p class="text-lg leading-9 *:font-semibold">
            <span>{{
              $t("planning.sprint_out_of_n", { current: 1, total: 4 })
            }}</span
            ><br />
            <span>{{ $t("planning.next_phase") }}</span>
            {{ $t("planning.build_phase") }}
          </p>
          <hr class="border-sc-black-300" />
          <div class="flex flex-col items-start gap-1.5 pt-1">
            <UTooltip
              :text="$t('planning.story_points_of_planned_user_stories')"
            >
              <div
                class="flex h-8 w-20 items-center justify-between rounded-md bg-sc-black-100 p-1.5"
              >
                <UIcon name="lucide:list-todo" class="size-6"> </UIcon>

                <span class="text-lg font-bold">
                  37<span class="text-xs">{{
                    $t("planning.story_points_abbreviation")
                  }}</span>
                </span>
              </div>
            </UTooltip>
            <UTooltip :text="$t('planning.velocity_to_date')" v-if="true">
              <div
                class="flex h-8 w-20 items-center justify-between rounded-md p-1.5"
                :class="
                  Math.random() > 0.5 ? 'bg-sc-green-100' : 'bg-sc-orange-100'
                "
              >
                <UIcon
                  name="mingcute:chart-bar-line"
                  class="size-6"
                  :class="
                    Math.random() > 0.5
                      ? 'text-sc-green-500'
                      : 'text-sc-orange-500'
                  "
                />
                <span class="text-lg font-bold">
                  37<span class="text-xs">{{
                    $t("planning.story_points_abbreviation")
                  }}</span>
                </span>
              </div>
            </UTooltip>
          </div>
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
