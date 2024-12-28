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
  <div class="relative h-full overflow-clip">
    <div
      class="relative z-10 flex h-full gap-6 pb-8 pl-9 pr-6 pt-5 xl:gap-12 xl:pb-16 xl:pl-[4.5rem] xl:pr-12 xl:pt-10"
    >
      <div class="flex w-0 flex-[7] flex-col gap-1.5">
        <h1 class="relative flex h-14 gap-3">
          <span
            class="font-heading text-4xl font-bold text-sc-orange xl:text-5xl"
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
            class="block h-14 w-0 flex-1 rounded-lg border border-sc-black-400 bg-sc-white px-4 py-3 font-sans text-xl font-medium text-black outline-sc-orange drop-shadow-md"
          />
          <InfoPopover
            v-if="showSprintNameInput"
            step="1"
            :text="$t('planning.set_a_sprint_name')"
          />
        </h1>
        <div class="relative">
          <div class="w-full">
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
                <th class="w-1/3 p-2 px-4 text-left">
                  {{ $t("planning.title") }}
                </th>
                <th class="w-2/3 p-2 px-4 text-left">
                  {{ $t("planning.description") }}
                </th>
                <th class="w-28">{{ $t("planning.story_points") }}</th>
                <th class="w-32">{{ $t("planning.responsible") }}</th>
                <th class="w-14"></th>
              </tr>
            </thead>
            <tbody class="divide-y">
              <template v-for="_ in Array(5)">
                <tr class="max-h-14 border-b border-sc-black-400">
                  <td class="p-2 pr-6">
                    <input
                      class="w-full rounded-lg bg-sc-white p-2 text-sm ring-inset focus:outline-none focus:!ring-2 focus:!ring-sc-orange [&:is(:placeholder-shown,:focus-within)]:shadow [&:is(:placeholder-shown,:focus-within)]:ring-1 [&:is(:placeholder-shown,:focus-within)]:ring-sc-black-400 [&:not(:placeholder-shown,:focus-within)]:cursor-pointer [&:not(:placeholder-shown,:focus-within)]:text-ellipsis [&:not(:placeholder-shown,:focus-within)]:py-0 [&:not(:placeholder-shown,:focus-within)]:text-lg [&:not(:placeholder-shown,:focus-within)]:font-medium"
                      @keydown.enter="
                        ($event.target as HTMLInputElement)?.blur()
                      "
                      :placeholder="$t('planning.title_of_us')"
                    />
                  </td>
                  <td class="p-2">
                    <div class="h-9 w-full">
                      <textarea
                        :placeholder="$t('planning.description_of_us')"
                        class="relative w-full resize-none rounded-lg bg-sc-white p-2 text-sm ring-inset focus-within:z-10 focus-within:h-36 focus-within:transition-[height] focus:outline-none focus:!ring-2 focus:!ring-sc-orange [&:is(:placeholder-shown,:focus-within)]:shadow [&:is(:placeholder-shown,:focus-within)]:ring-1 [&:is(:placeholder-shown,:focus-within)]:ring-sc-black-400 [&:not(:focus-within)]:h-9 [&:not(:focus-within)]:overflow-clip [&:not(:placeholder-shown,:focus-within)]:cursor-pointer"
                      ></textarea>
                    </div>
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
      <div class="flex w-0 flex-[3] flex-col justify-end">
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
                :class="true ? 'bg-sc-green-100' : 'bg-sc-orange-100'"
              >
                <UIcon
                  name="mingcute:chart-bar-line"
                  class="size-6"
                  :class="true ? 'text-sc-green-500' : 'text-sc-orange-500'"
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
      class="absolute right-2 top-0 z-0 h-52 w-auto lg:h-60 xl:right-24 xl:h-[clamp(13rem,calc(100vh-35rem),20rem)]"
      :remainingSeconds
    ></Timer>
    <SvgMeetingScreenTrees
      :font-controlled="false"
      filled
      class="absolute bottom-0 z-0 h-auto w-[100vw]"
    ></SvgMeetingScreenTrees>
    <Infobox
      class="relative z-20"
      :text="[
        {
          title: $t('planning.infobox.sprint_names.title'),
          content: $t('planning.infobox.sprint_names.content'),
        },
        {
          title: $t('planning.infobox.sprint_goal.title'),
          content: $t('planning.infobox.sprint_goal.content'),
        },
        {
          title: $t('planning.infobox.user_stories.title'),
          content: $t('planning.infobox.user_stories.content'),
        },
        {
          title: $t('planning.infobox.story_points.title'),
          content: $t('planning.infobox.story_points.content'),
        },
      ]"
    >
    </Infobox>
  </div>
</template>
