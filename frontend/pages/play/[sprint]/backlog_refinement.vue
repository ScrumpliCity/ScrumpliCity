<script setup>
definePageMeta({
  middleware: "ensure-playing",
  layout: "in-game",
});

const game = useGameStore();

const isModalOpen = ref(
  game.team.room.current_sprint != game.team.room.number_of_sprints &&
    game.currentSprint.user_stories.filter((us) => !us.completed).length > 0,
);

const selectedContent = ref({});
const acceptedSP = computed(() =>
  game.currentSprint.user_stories
    .filter((us) => us.completed)
    .reduce((acc, us) => acc + us.story_points, 0),
);

const plannedSP = computed(() =>
  game.currentSprint.user_stories.reduce((acc, us) => acc + us.story_points, 0),
);

async function manageUS(preserveUS) {
  try {
    await game.manageUserStories(preserveUS);
  } catch (error) {
    console.error(error);
  }
  isModalOpen.value = false;
}
</script>
<template>
  <div class="relative h-full overflow-clip" @click="selectedContent = {}">
    <div
      class="relative z-10 flex h-full gap-6 pb-8 pl-9 pr-6 xl:gap-12 xl:pb-8 xl:pl-[4.5rem] xl:pr-12"
    >
      <div class="flex w-[64vw] flex-[7] flex-col gap-3 pt-5 xl:pt-10">
        <h1
          class="h-12 gap-3 font-heading text-4xl font-bold text-sc-orange xl:h-14 xl:text-5xl"
        >
          {{
            $t("backlog_refinement.backlog_refinement", {
              sprint_name: game.currentSprint.name,
            })
          }}
        </h1>
        <div class="w-full">
          <span
            class="pointer-events-none flex w-full items-center gap-2 px-2.5 text-base"
          >
            <UIcon name="octicon:goal-16" class="size-5" />
            {{ game.currentSprint.goal }}
          </span>
        </div>
        <div class="mt-1.5">
          <h2 class="font-heading text-2xl font-bold text-sc-orange">
            {{
              $t("backlog_refinement.not_accepted_user_stories", {
                accepted: game.currentSprint.user_stories.filter(
                  (us) => !us.completed,
                ).length,
                planned: game.currentSprint.user_stories.length,
              })
            }}
          </h2>
        </div>
        <div
          class="relative mt-1.5 max-w-[64vw] flex-1 overflow-clip rounded-2xl border-2 border-sc-black-400 bg-sc-white"
          @click.stop
        >
          <table class="w-full table-fixed divide-y-2 divide-sc-black-400 pr-2">
            <thead>
              <tr
                class="h-11 rounded-t-2xl border-b-2 border-sc-black-400 bg-sc-orange-100 font-semibold"
              >
                <th class="pl-4 text-left">
                  {{ $t("backlog_refinement.title") }}
                </th>
                <th class="py-2 text-left">
                  {{ $t("backlog_refinement.description") }}
                </th>
                <th class="">
                  {{ $t("backlog_refinement.story_points") }}
                </th>
                <th class="text-left">
                  {{ $t("backlog_refinement.responsible") }}
                </th>
              </tr>
            </thead>
          </table>
          <div class="h-full max-h-[55vh] overflow-y-auto xl:max-h-[50vh]">
            <table class="w-full table-fixed divide-y-2 divide-sc-black-400">
              <tbody class="h-full w-full divide-y">
                <template
                  v-for="userStory in game.currentSprint.user_stories.filter(
                    (us) => !us.completed,
                  )"
                >
                  <tr
                    class="h-14 w-full border-b border-sc-black-400 text-lg hover:bg-sc-black-50"
                    @click="selectedContent = userStory"
                  >
                    <td
                      class="truncate p-4 pr-6 font-medium"
                      :class="{ italic: !userStory.title }"
                    >
                      {{ userStory.title || $t("backlog_refinement.no_title") }}
                    </td>
                    <td
                      class="truncate text-sm"
                      :class="{ italic: !userStory.description }"
                    >
                      {{
                        userStory.description ||
                        $t("backlog_refinement.no_description")
                      }}
                    </td>
                    <td class="text-center">
                      <div
                        class="mx-auto size-7 rounded-full bg-sc-black-100 text-center text-lg font-semibold text-sc-black"
                      >
                        {{ userStory.story_points || 0 }}
                      </div>
                    </td>
                    <td class="flex h-14 items-center text-left">
                      {{
                        userStory.member?.name ||
                        $t("backlog_refinement.no_responsible")
                      }}
                    </td>
                  </tr>
                </template>
                <tr
                  v-if="
                    game.currentSprint.user_stories.filter(
                      (us) => !us.completed,
                    ).length <= 0
                  "
                  class="border-sc-black-400"
                >
                  <td colspan="4" class="py-8">
                    <p class="w-full text-center text-lg/8 text-sc-black">
                      {{ $t("backlog_refinement.all_user_stories_accepted") }}
                    </p>
                  </td>
                </tr>
                <tr
                  v-else
                  class="border-t border-sc-black-400"
                  :class="{
                    'h-56 xl:h-52': isModalOpen,
                  }"
                ></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="flex h-full w-0 flex-[3] flex-col justify-between gap-8">
        <Timer
          :total-seconds="game.timerTotalSeconds ?? 0"
          :is-paused="game.timerState === 'paused'"
          :is-disabled="game.timerState === 'stopped'"
          :remaining-seconds="game.timerRemainingSeconds ?? 0"
          class="z-0 h-fit w-auto max-w-[90%] flex-shrink justify-start self-center pt-0"
        >
        </Timer>
        <div
          class="flex h-72 flex-col gap-2 rounded-2xl border-2 border-sc-black-400 bg-sc-white p-5"
          v-if="selectedContent.id"
        >
          <div class="flex items-center justify-between">
            <div class="flex flex-col gap-1">
              <h3
                class="text-xl font-semibold"
                :class="{ italic: !selectedContent.title }"
              >
                {{ selectedContent.title || $t("backlog_refinement.no_title") }}
              </h3>
              <div class="text-sm">
                <span class="font-semibold"
                  >{{ $t("backlog_refinement.responsible") }}:
                </span>
                <span :class="{ italic: !selectedContent.member?.name }">{{
                  selectedContent.member?.name ||
                  $t("backlog_refinement.no_responsible")
                }}</span>
              </div>
            </div>
            <span
              class="mr-5 size-7 min-w-7 self-start rounded-full bg-sc-black-100 text-center text-lg font-semibold text-sc-black"
              >{{ selectedContent.story_points || 0 }}</span
            >
          </div>
          <hr class="border-sc-black-300" />
          <div class="overflow-y-auto pr-1">
            <p
              class="whitespace-pre-line text-sm"
              :class="{ italic: !selectedContent.description }"
            >
              {{
                selectedContent.description ||
                $t("backlog_refinement.no_description")
              }}
            </p>
          </div>
        </div>
        <div
          class="flex h-72 flex-col gap-2 rounded-2xl border-2 border-sc-black-400 bg-sc-white p-5"
          v-else
        >
          <h3 class="text-xl font-semibold">{{ game.team.name }}</h3>
          <hr class="border-sc-black-300" />
          <p class="text-lg leading-9 *:font-semibold">
            <span>{{
              $t("backlog_refinement.sprint_out_of_n", {
                current: game.team.room.current_sprint,
                total: game.team.room.number_of_sprints,
              })
            }}</span
            ><br />
            <span>{{ $t("backlog_refinement.next_phase") }}</span>
            {{ $t("backlog_refinement.planning") }}
          </p>
          <hr class="border-sc-black-300" />
          <div class="flex w-44 flex-wrap items-start gap-x-3 gap-y-1.5 pt-1">
            <UTooltip
              :text="
                $t('backlog_refinement.story_points_of_planned_user_stories')
              "
            >
              <div
                class="flex h-8 w-20 items-center justify-between rounded-md bg-sc-black-100 p-1.5"
              >
                <UIcon name="lucide:list-todo" class="size-6"> </UIcon>

                <span class="text-lg font-bold">
                  {{ plannedSP
                  }}<span class="text-xs">{{
                    $t("backlog_refinement.story_points_abbreviation")
                  }}</span>
                </span>
              </div>
            </UTooltip>
            <UTooltip
              :text="$t('backlog_refinement.accepted_story_points')"
              v-if="true"
            >
              <div
                class="flex h-8 w-20 items-center justify-between rounded-md p-1.5"
                :class="true ? 'bg-sc-green-100' : 'bg-sc-orange-100'"
              >
                <SvgUserStoriesAccepted
                  class="size-[22px]"
                  :font-controlled="false"
                  filled
                  :class="false ? 'text-sc-green-500' : 'text-sc-orange-500'"
                />
                <span class="text-lg font-bold">
                  {{ acceptedSP
                  }}<span class="text-xs">{{
                    $t("backlog_refinement.story_points_abbreviation")
                  }}</span>
                </span>
              </div>
            </UTooltip>
            <UTooltip
              :text="$t('backlog_refinement.velocity_to_date')"
              v-if="true"
            >
              <div
                class="flex h-8 w-20 items-center justify-between rounded-md p-1.5"
                :class="{
                  'bg-sc-green-100':
                    plannedSP < game.currentSprint.velocity &&
                    game.currentSprint.number !== 1,
                  'bg-sc-orange-100':
                    plannedSP >= game.currentSprint.velocity &&
                    game.currentSprint.number !== 1,
                  'bg-sc-black-100': game.currentSprint.sprint_number === 1,
                }"
              >
                <UIcon
                  name="mingcute:chart-bar-line"
                  class="size-6"
                  :class="{
                    'text-sc-green-500':
                      plannedSP < game.currentSprint.velocity &&
                      game.currentSprint.sprint_number !== 1,
                    'text-sc-orange-500':
                      plannedSP >= game.currentSprint.velocity &&
                      game.currentSprint.number !== 1,
                  }"
                />
                <span class="text-lg font-bold">
                  {{
                    game.currentSprint.sprint_number === 1
                      ? acceptedSP
                      : game.currentSprint.velocity
                  }}<span class="text-xs">{{
                    $t("backlog_refinement.story_points_abbreviation")
                  }}</span>
                </span>
              </div>
            </UTooltip>
          </div>
        </div>
      </div>
    </div>
    <div
      v-if="isModalOpen"
      class="absolute bottom-[10vh] left-1/2 z-30 max-w-[452px] -translate-x-1/2 transform drop-shadow-sc-shadow"
    >
      <div
        class="flex flex-col gap-2 rounded-lg border border-sc-black-400 bg-sc-black-50 px-8 py-4 text-center"
      >
        <p>{{ $t("backlog_refinement.modal.question") }}</p>
        <div
          class="mt-1 flex justify-center gap-10 text-sc-white *:text-base *:font-bold"
        >
          <UButton
            @click="manageUS(true)"
            class="bg-sc-green-500 p-[10px] hover:bg-sc-green-600"
            :ui="{
              rounded: 'rounded-[10px]',
              variant: 'solid',
            }"
          >
            {{ $t("backlog_refinement.modal.accept") }}
          </UButton>
          <UButton
            @click="manageUS(false)"
            class="bg-[#EF4444] p-[10px] hover:bg-[#BC1010]"
            :ui="{
              rounded: 'rounded-[10px]',
              variant: 'solid',
            }"
          >
            {{ $t("backlog_refinement.modal.reject") }}
          </UButton>
        </div>
        <p class="text-xs">{{ $t("backlog_refinement.modal.note") }}</p>
      </div>
    </div>

    <SvgMeetingScreenTrees
      :font-controlled="false"
      filled
      class="absolute bottom-0 z-0 h-auto w-[100vw]"
    >
    </SvgMeetingScreenTrees>
    <Infobox
      class="relative z-20"
      :text="[
        {
          title: $t('backlog_refinement.infobox.title'),
          content: $t('backlog_refinement.infobox.content'),
        },
      ]"
    >
    </Infobox>
  </div>
</template>
