<script setup>
definePageMeta({
  middleware: "ensure-playing",
  layout: "in-game",
});

const sprint = ref({
  number: 1,
  total: 4,
  name: "Amsterdam",
  sprint_goal: "Wasserversorgung der Bewohner sichern.",
  team_name: "Die Besten",
  velocity: 0,
  user_stories: [
    {
      id: 1,
      title: "Erstes Haus",
      description:
        "Als Bewohner möchte ich ein stabil gebautes Haus haben, um sicher wohnen zu können.",
      responsible: "Lisa Marie-Hörmann",
      storyPoints: 13,
      accepted: false,
    },
    {
      id: 2,
      title: "Kläranlage",
      description:
        "Als Bewohner möchte ich eine funktionierende Kläranlage haben, um die Umwelt nicht zu verschmutzen.",
      responsible: "Felix Wollmann",
      storyPoints: 5,
      accepted: false,
    },
    {
      id: 3,
      title: "Wasserturm",
      description:
        "Als Bewohner möchte ich einen Wasserturm haben, um eine konstante Wasserversorgung zu haben.",
      responsible: "Sophie Nemecek",
      storyPoints: 3,
      accepted: false,
    },
  ],
});

const selectedContent = ref({});
const acceptedSP = computed(() =>
  sprint.value.user_stories
    .filter((us) => us.accepted)
    .reduce((acc, us) => acc + us.storyPoints, 0),
);

const plannedSP = computed(() =>
  sprint.value.user_stories.reduce((acc, us) => acc + us.storyPoints, 0),
);

async function toggleAccepted(checked) {
  // implement with backend
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
          {{ $t("review.review") }} — {{ sprint.name }}
        </h1>
        <div class="w-full">
          <span
            class="pointer-events-none flex w-full items-center gap-2 px-2.5 text-base"
          >
            <UIcon name="octicon:goal-16" class="size-5" />
            {{ sprint.sprint_goal }}
          </span>
        </div>
        <div
          class="relative mt-1.5 max-w-[64vw] flex-1 overflow-clip rounded-2xl border-2 border-sc-black-400 bg-sc-white"
          @click.stop
        >
          <table class="w-full table-fixed divide-y-2 divide-sc-black-400">
            <thead>
              <tr
                class="h-11 rounded-t-2xl bg-sc-orange-100 pl-2 pr-16 font-semibold"
              >
                <th class="w-1/3 p-2 px-4 text-left">
                  {{ $t("review.title") }}
                </th>
                <th class="w-2/3 p-2 pl-0 pr-4 text-left">
                  {{ $t("review.description") }}
                </th>
                <th class="w-28">{{ $t("review.story_points") }}</th>
                <th class="w-48 pr-16">{{ $t("review.approved") }}</th>
              </tr>
            </thead>
            <tbody class="w-full divide-y">
              <template v-for="userStory in sprint.user_stories">
                <tr
                  class="h-14 w-full border-b border-sc-black-400 text-lg hover:bg-sc-black-50"
                  @click="selectedContent = userStory"
                >
                  <td class="truncate p-4 pr-6 font-medium">
                    {{ userStory.title }}
                  </td>
                  <td class="truncate text-sm">
                    {{ userStory.description }}
                  </td>
                  <td class="text-center">
                    <div
                      class="mx-auto size-7 rounded-full bg-sc-black-100 text-center text-lg font-semibold text-sc-black"
                    >
                      {{ userStory.storyPoints }}
                    </div>
                  </td>
                  <td
                    class="flex h-14 items-center justify-center pr-16 text-center"
                  >
                    <UCheckbox
                      v-model="userStory.accepted"
                      class="size-4 rounded-[4px]"
                      color="green"
                      @change="(e) => toggleAccepted(e.checked)"
                      @click.stop
                    />
                  </td>
                </tr>
              </template>
              <tr class="border-t border-sc-black-400"></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="flex h-full w-0 flex-[3] flex-col justify-between gap-8">
        <Timer
          :total-seconds="120"
          class="z-0 h-fit w-auto max-w-[90%] flex-shrink justify-start self-center pt-0"
          :remainingSeconds="118"
        ></Timer>
        <div
          class="flex h-72 flex-grow flex-col gap-2 rounded-2xl border-2 border-sc-black-400 bg-sc-white p-5"
          v-if="selectedContent.id"
        >
          <div class="flex items-center justify-between">
            <div class="flex flex-col gap-1">
              <h3 class="text-xl font-semibold">{{ selectedContent.title }}</h3>
              <div class="text-sm">
                <span class="font-semibold"
                  >{{ $t("review.responsible") }}:
                </span>
                <span>{{ selectedContent.responsible }}</span>
              </div>
            </div>
            <span
              class="mr-5 size-7 min-w-7 self-start rounded-full bg-sc-black-100 text-center text-lg font-semibold text-sc-black"
              >{{ selectedContent.storyPoints }}</span
            >
          </div>
          <hr class="border-sc-black-300" />
          <div class="overflow-y-auto pr-1">
            <p class="text-sm">
              {{ selectedContent.description }}
            </p>
          </div>
        </div>
        <div
          class="flex h-72 flex-col gap-2 rounded-2xl border-2 border-sc-black-400 bg-sc-white p-5"
          v-else
        >
          <h3 class="text-xl font-semibold">{{ sprint.team_name }}</h3>
          <hr class="border-sc-black-300" />
          <p class="text-lg leading-9 *:font-semibold">
            <span>{{
              $t("review.sprint_out_of_n", {
                current: sprint.number,
                total: sprint.total,
              })
            }}</span
            ><br />
            <span>{{ $t("review.next_phase") }}</span>
            {{ $t("review.planning") }}
          </p>
          <hr class="border-sc-black-300" />
          <div class="flex w-44 flex-wrap items-start gap-x-3 gap-y-1.5 pt-1">
            <UTooltip :text="$t('review.story_points_of_planned_user_stories')">
              <div
                class="flex h-8 w-20 items-center justify-between rounded-md bg-sc-black-100 p-1.5"
              >
                <UIcon name="lucide:list-todo" class="size-6"> </UIcon>

                <span class="text-lg font-bold">
                  {{ plannedSP
                  }}<span class="text-xs">{{
                    $t("review.story_points_abbreviation")
                  }}</span>
                </span>
              </div>
            </UTooltip>
            <UTooltip :text="$t('review.accepted_story_points')" v-if="true">
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
                    $t("review.story_points_abbreviation")
                  }}</span>
                </span>
              </div>
            </UTooltip>
            <UTooltip :text="$t('review.velocity_to_date')" v-if="true">
              <div
                class="flex h-8 w-20 items-center justify-between rounded-md p-1.5"
                :class="{
                  'bg-sc-green-100':
                    plannedSP < sprint.velocity && sprint.number !== 1,
                  'bg-sc-orange-100':
                    plannedSP >= sprint.velocity && sprint.number !== 1,
                  'bg-sc-black-100': sprint.number === 1,
                }"
              >
                <UIcon
                  name="mingcute:chart-bar-line"
                  class="size-6"
                  :class="{
                    'text-sc-green-500':
                      plannedSP < sprint.velocity && sprint.number !== 1,
                    'text-sc-orange-500':
                      plannedSP >= sprint.velocity && sprint.number !== 1,
                  }"
                />
                <span class="text-lg font-bold">
                  {{ sprint.number === 1 ? acceptedSP : sprint.velocity
                  }}<span class="text-xs">{{
                    $t("review.story_points_abbreviation")
                  }}</span>
                </span>
              </div>
            </UTooltip>
          </div>
        </div>
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
          title: $t('review.infobox.title'),
          content: $t('review.infobox.content'),
        },
      ]"
    >
    </Infobox>
  </div>
</template>
