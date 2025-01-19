<script setup>
definePageMeta({
  middleware: "ensure-playing",
  layout: "in-game",
});

const sprint = ref({
  number: 1,
  name: "Amsterdam",
  sprint_goal:
    "Build the residential district of our paper city, focusing on constructing houses from blueprints",
  user_stories: [
    {
      id: 1,
      title: "Bauphase",
      description:
        "Als Schüler*in möchte ich während der Bauphase User Storys als fertig markieren, um meinem Team zu signalisieren, dass die Arbeit abgeschlossen ist.",
      responsible: "Lisa Marie-Hörmann",
      storyPoints: 13,
      acceptence_criteria: [
        "Im Hintergrund sind Illustrationen/Animationen zu sehen, die signalisieren, dass gerade die Bauphase stattfindet.",
        "Die SchülerInnen können User Storys als erledigt markieren und auch was ganz anderes wichtiges weil naja und wenn du bis da hin gelesen hast.",
      ],
    },
    {
      id: 2,
      title: "Sprint-Planning: Sprintname",
      description:
        "Als Schüler*in möchte ich einen Sprintnamen vergeben können...",
      responsible: "Felix Wollmann",
      storyPoints: 2,
      acceptence_criteria: [
        "Der Sprintname wird in der Kopfzeile des Spiels angezeigt.",
        "Der Sprintname wird in der Kopfzeile des Spiels angezeigt.",
        "Der Sprintname wird in der Kopfzeile des Spiels angezeigt.",
      ],
    },
  ],
});

const selectedUS = ref(sprint.value.user_stories[0]);

async function setDone(checked) {
  // try {
  //     const response = await client("/api/tba", {
  //         method: "PATCH",
  //         body: {
  //             done: checked,
  //         },
  //     });
  // } catch (error) {
  //     console.error(error);
  // }
}
</script>
<template>
  <div class="relative h-full overflow-clip">
    <div
      class="relative z-10 flex h-full gap-6 pb-8 pl-9 pr-6 pt-5 xl:gap-12 xl:pb-16 xl:pl-[4.5rem] xl:pr-12 xl:pt-10"
    >
      <div class="flex flex-[7] flex-col gap-2">
        <h1
          class="h-14 gap-3 font-heading text-4xl font-bold text-sc-orange xl:text-5xl"
        >
          {{ $t("build_phase.build_phase") }}
        </h1>
        <div
          class="relative mt-1.5 flex-1 overflow-clip rounded-2xl border-2 border-sc-black-400 bg-sc-white"
        >
          <table
            class="w-full max-w-full table-auto divide-y-2 divide-sc-black-400"
          >
            <thead>
              <tr class="h-11 rounded-t-2xl bg-sc-orange-100 font-semibold">
                <th class="py-2 pl-10 text-left text-lg" colspan="3">
                  {{ sprint.name }}
                </th>
              </tr>
            </thead>
            <tbody class="max-w-full divide-y">
              <template v-for="userStory in sprint.user_stories">
                <tr
                  class="max-h-14 cursor-pointer border-b border-sc-black-400 text-lg hover:bg-sc-black-50"
                  @click="selectedUS = userStory"
                >
                  <td class="flex max-w-[45vw] items-center gap-8 py-2 pl-4">
                    <span class="whitespace-nowrap font-medium">
                      {{ userStory.title }}
                    </span>
                    <span
                      class="inline-block overflow-hidden text-ellipsis whitespace-nowrap text-sm"
                    >
                      {{ userStory.description }}
                    </span>
                  </td>
                  <td class="pl-3 pr-3 align-middle">
                    <div
                      class="size-7 min-w-7 flex-none rounded-full bg-sc-black-100 text-center text-lg font-semibold text-sc-black"
                    >
                      {{ userStory.storyPoints }}
                    </div>
                  </td>
                  <td class="whitespace-nowrap pr-4 text-lg font-semibold">
                    <div
                      class="inline-flex items-center gap-3 rounded-[5px] border border-sc-black-200 px-2"
                      @click.stop
                    >
                      {{ $t("build_phase.in_progress") }}
                      <div class="relative h-5 w-9">
                        <input
                          :id="'switch-component-' + userStory.id"
                          type="checkbox"
                          class="peer h-5 w-9 cursor-pointer appearance-none rounded-full bg-gray-200 transition-colors duration-300 checked:bg-sc-green-500"
                          @change="(e) => setDone(e.checked)"
                        />
                        <label
                          :for="'switch-component-' + userStory.id"
                          class="absolute left-0.5 top-[0.1875rem] h-4 w-4 cursor-pointer rounded-full bg-sc-white shadow-sm transition-transform duration-300 peer-checked:translate-x-[1rem]"
                        >
                        </label>
                      </div>
                      {{ $t("build_phase.done") }}
                    </div>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
      <div class="flex w-0 flex-[3] flex-col justify-end">
        <div
          class="flex h-72 flex-col gap-2 rounded-2xl border-2 border-sc-black-400 bg-sc-white p-5"
        >
          <div class="flex items-center justify-between">
            <div class="flex flex-col gap-1">
              <h3 class="text-xl font-semibold">{{ selectedUS.title }}</h3>
              <div class="text-sm">
                <span class="font-semibold"
                  >{{ $t("build_phase.responsible") }}:
                </span>
                <span>{{ selectedUS.responsible }}</span>
              </div>
            </div>
            <span
              class="mr-5 size-7 min-w-7 self-start rounded-full bg-sc-black-100 text-center text-lg font-semibold text-sc-black"
              >{{ selectedUS.storyPoints }}</span
            >
          </div>
          <hr class="border-sc-black-300" />
          <div class="overflow-y-auto pr-1">
            <p class="text-sm italic">
              {{ selectedUS.description }}
            </p>
            <div class="mt-2 text-sm">
              <h4 class="text-sm font-semibold">
                {{ $t("build_phase.acceptence_criteria") }}:
              </h4>
              <ul class="flex list-outside list-disc flex-col gap-2 pl-6">
                <li v-for="criteria in selectedUS.acceptence_criteria">
                  {{ criteria }}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Timer
      :total-seconds="120"
      class="absolute right-2 top-0 z-0 h-72 w-auto lg:h-60 xl:right-24 xl:h-[clamp(13rem,calc(100vh-29rem),20rem)]"
      :remainingSeconds="118"
    ></Timer>
    <div class="overflow-clip">
      <SvgBuildPhaseBg
        :font-controlled="false"
        filled
        class="absolute bottom-0 right-[calc(31.5vw-1.5rem)] h-[calc(96vh-4rem)] xl:right-[30vw]"
      >
      </SvgBuildPhaseBg>
      <SvgLightBeams
        class="absolute right-[calc(34.5vw-1.5rem)] top-[4.5rem] z-40 w-[12.5%] xl:right-[35.5vw]"
        :font-controlled="false"
        filled
      />
    </div>
  </div>
</template>
