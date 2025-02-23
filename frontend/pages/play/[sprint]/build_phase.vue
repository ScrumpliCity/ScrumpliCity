<script setup>
definePageMeta({
  middleware: "ensure-playing",
  layout: "in-game",
});

const game = useGameStore();

const selectedUS = ref(game.currentSprint.user_stories[0]); // DOD-US: Implement DOD display (including on focusout/etc.)
</script>
<template>
  <div class="relative h-full overflow-clip">
    <div
      class="relative z-10 flex h-full gap-6 pb-8 pl-9 pr-6 xl:gap-12 xl:pb-8 xl:pl-[4.5rem] xl:pr-12"
    >
      <div class="flex w-[64vw] flex-[7] flex-col gap-2 pt-5 xl:pt-10">
        <h1
          class="h-14 gap-3 font-heading text-4xl font-bold text-sc-orange xl:text-5xl"
        >
          {{ $t("build_phase.build_phase") }}
        </h1>
        <div
          class="relative mt-1.5 max-w-[64vw] flex-1 overflow-clip rounded-2xl border-2 border-sc-black-400 bg-sc-white"
        >
          <table class="w-full table-fixed divide-y-2 divide-sc-black-400">
            <thead>
              <tr class="h-11 rounded-t-2xl bg-sc-orange-100 font-semibold">
                <th class="py-2 pl-10 text-left text-lg" colspan="1">
                  {{ game.currentSprint.name }}
                </th>
              </tr>
            </thead>
            <tbody class="divide-y">
              <template v-for="userStory in game.currentSprint.user_stories">
                <tr
                  class="w-full border-b border-sc-black-400 text-lg hover:bg-sc-black-50"
                  @click="selectedUS = userStory"
                >
                  <td class="w-full">
                    <div
                      class="flex h-14 w-full cursor-pointer items-center justify-between"
                    >
                      <div
                        class="my-2 ml-4 flex w-full min-w-0 items-center gap-8"
                      >
                        <span class="min-w-fit whitespace-nowrap font-medium">
                          {{ userStory.title }}
                        </span>
                        <span class="flex-1 truncate text-sm">
                          {{ userStory.description }}
                        </span>
                      </div>

                      <div
                        class="my-2 ml-3 mr-4 size-7 min-w-7 flex-none rounded-full bg-sc-black-100 text-center text-lg font-semibold text-sc-black"
                      >
                        {{ userStory.story_points }}
                      </div>

                      <div
                        class="mr-4 inline-flex shrink-0 items-center gap-3 rounded-[5px] border border-sc-black-200 px-2 text-lg font-semibold"
                        @click.stop
                      >
                        {{ $t("build_phase.in_progress") }}
                        <div class="relative h-5 w-9">
                          <input
                            :id="'switch-component-' + userStory.id"
                            type="checkbox"
                            class="peer h-5 w-9 cursor-pointer appearance-none rounded-full bg-gray-200 transition-colors duration-300 checked:bg-sc-green-500"
                          />
                          <label
                            :for="'switch-component-' + userStory.id"
                            class="absolute left-0.5 top-[0.1875rem] h-4 w-4 cursor-pointer rounded-full bg-sc-white shadow-sm transition-transform duration-300 peer-checked:translate-x-[1rem]"
                          >
                          </label>
                        </div>
                        {{ $t("build_phase.done") }}
                      </div>
                    </div>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
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
          class="flex h-72 flex-grow flex-col gap-2 rounded-2xl border-2 border-sc-black-400 bg-sc-white p-5"
        >
          <div class="flex items-center justify-between">
            <div class="flex flex-col gap-1">
              <h3 class="text-xl font-semibold">{{ selectedUS.title }}</h3>
              <div class="text-sm">
                <span class="font-semibold"
                  >{{ $t("build_phase.responsible") }}:
                </span>
                <span>{{ selectedUS.member.name }}</span>
              </div>
            </div>
            <span
              class="mr-5 size-7 min-w-7 self-start rounded-full bg-sc-black-100 text-center text-lg font-semibold text-sc-black"
              >{{ selectedUS.story_points }}</span
            >
          </div>
          <hr class="border-sc-black-300" />
          <div class="overflow-y-auto pr-1">
            <p class="whitespace-pre-line text-sm">
              {{ selectedUS.description }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="overflow-clip">
      <SvgBuildPhaseBg
        :font-controlled="false"
        filled
        class="absolute bottom-0 right-[calc(31.5vw-1.5rem)] h-[calc(96vh-4rem)] xl:right-[30vw]"
      >
      </SvgBuildPhaseBg>
    </div>
  </div>
</template>
