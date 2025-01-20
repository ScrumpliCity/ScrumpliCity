<script setup>
const props = defineProps({
  phase: {
    type: String,
  },
  sprintCount: {
    type: Number,
    required: true,
  },
  currentSprint: {
    type: Number,
    required: true,
  },
  timeLeft: {
    type: Number,
    required: false,
    default: 300,
  },
  isCompleted: {
    type: Boolean,
    required: false,
    default: false,
  },
});

const { t } = useI18n();

const phase = ref(props.phase || "default");

const phaseInfos = computed(() => {
  const i18nPath = "rooms.phase_box.";
  const nextPhase = {
    planning: "build_phase",
    build_phase: "review",
    review: "backlog_refinement",
    backlog_refinement: "planning",
    default: "planning",
  };

  return {
    text: t(i18nPath + phase.value),
    nextPhase: t(i18nPath + nextPhase[phase.value]),
    currentPhaseIndex: Object.keys(nextPhase).indexOf(phase.value),
    phaseCount: Object.keys(nextPhase).length - 1,
  };
});
</script>
<template>
  <div class="flex flex-col gap-3">
    <div
      class="z-10 flex h-[11.625rem] w-[26.25rem] gap-8 rounded-lg border border-sc-black-400 bg-sc-black-50 pb-10 pl-10 pt-12 drop-shadow"
    >
      <div class="size-[5.625rem] *:size-full" :fontControlled="false">
        <LazySvgSprintPlanningSM
          filled
          :fontControlled="false"
          v-if="phase === 'planning'"
        />
        <LazySvgBuildingPhaseSM
          filled
          :fontControlled="false"
          v-else-if="phase === 'build_phase'"
        />
        <LazySvgSprintReviewSM
          filled
          :fontControlled="false"
          v-else-if="phase === 'review'"
        />
        <LazySvgBacklogRefinementSM
          filled
          :fontControlled="false"
          v-else-if="phase === 'backlog_refinement'"
        />
        <LazySvgScrumProcessSM filled :fontControlled="false" v-else />
      </div>
      <div class="flex flex-col gap-1">
        <h2 class="text-2xl font-bold text-sc-black">
          {{ $t("rooms.phase_box.sprint") }} {{ currentSprint }} /
          {{ sprintCount }}
        </h2>
        <div class="flex flex-col" v-if="!isCompleted" :key="phaseInfos.text">
          <h3 class="text-2xl text-sc-black">{{ phaseInfos.text }}</h3>
          <p class="text-sm text-sc-black-700">
            {{ $t("rooms.phase_box.next_phase") }}: {{ phaseInfos.nextPhase }}
          </p>
        </div>
      </div>
    </div>
    <div class="z-10 flex w-full flex-col items-end" v-if="phase !== 'default'">
      <UProgress
        :value="(50 / phaseInfos.phaseCount) * phaseInfos.currentPhaseIndex + 1"
        :ui="{
          wrapper: 'border border-sc-black-400 rounded-[5px]',
          progress: {
            size: 'xl',
            color:
              '[&::-webkit-progress-value]:!rounded-[5px] [&::-moz-progress-bar]:!rounded-[5px] text-sc-orange',
            rounded: 'rounded-[5px] [&::-webkit-progress-bar]:rounded-[5px]',
            track:
              '[&::-webkit-progress-bar]:bg-sc-white [@supports(selector(&::-moz-progress-bar))]:bg-sc-white',
          },
        }"
        class="drop-shadow"
        :max="50"
        v-if="phase !== 'default'"
      />
      <p class="leading-9 text-sc-black-700">
        {{ $t("rooms.phase_box.end_of_sprint") }}
        <ClientOnly>
          <span class="font-bold">{{
            new Date(Date.now() + timeLeft * 1000).toLocaleTimeString(
              $i18n.locale,
              { hour: "2-digit", minute: "2-digit" },
            )
          }}</span>
        </ClientOnly>
      </p>
    </div>
  </div>
</template>
