<script setup>
definePageMeta({
  layout: "in-game",
  middleware: "ensure-playing",
});
import confetti from "canvas-confetti";
const game = useGameStore();

// Calculate completed user stories across all sprints
const completedUserStories = game.team.sprints
  .flatMap((sprint) => sprint.user_stories || [])
  .filter((us) => us.completed);

const completedUserStoryCount = completedUserStories.length;
const completedStoryPoints = completedUserStories.reduce(
  (acc, us) => acc + us.story_points,
  0,
);
const velocity = completedStoryPoints / game.team.room.number_of_sprints;

onMounted(() => {
  confettiRain();
});

function confettiRain() {
  var duration = 15 * 1000;
  var animationEnd = Date.now() + duration;
  var skew = 1;

  function randomInRange(min, max) {
    return Math.random() * (max - min) + min;
  }

  (function frame() {
    var timeLeft = animationEnd - Date.now();
    var ticks = Math.max(200, 500 * (timeLeft / duration));
    skew = Math.max(0.8, skew - 0.001);

    confetti({
      particleCount: 1,
      startVelocity: 0,
      ticks: ticks,
      origin: {
        x: Math.random(),
        // since particles fall down, skew start toward the top
        y: Math.random() * skew - 0.2,
      },
      colors: ["#ffffff"],
      shapes: ["circle"],
      gravity: randomInRange(0.4, 0.6),
      scalar: randomInRange(0.4, 1),
      drift: randomInRange(-0.4, 0.4),
    });

    if (timeLeft > 0) {
      requestAnimationFrame(frame);
    }
  })();
}
</script>
<template>
  <div class="mb-9 mt-12 flex flex-col items-center justify-center gap-6">
    <h1 class="font-heading text-8xl font-bold">
      {{ $t("congratulations.title") }}
    </h1>
    <h2 class="w-2/5 text-center text-2xl">
      {{ $t("congratulations.subheading") }}
    </h2>
    <div
      class="flex w-[36vw] flex-col gap-3 rounded-[1.25rem] border-2 border-sc-black-400 px-6 pb-5 pt-[1.875rem]"
    >
      <h3 class="text-xl font-semibold">{{ game.team.name }}</h3>
      <UTooltip
        :text="$t('congratulations.copy_tooltip')"
        class="absolute right-5 top-5"
      >
        <UButton icon="ic:baseline-content-copy"></UButton>
      </UTooltip>
      <hr class="mt-[2px] border border-sc-black-300" />

      <div class="ml-1.5 flex flex-col gap-4 text-xl">
        <div class="flex items-center gap-6">
          <SvgScrumProcessSM filled :fontControlled="false" class="size-6" />
          {{
            $t("congratulations.sprint", {
              sprints: game.team.room.number_of_sprints,
            })
          }}
        </div>
        <div class="flex items-center gap-6">
          <p class="text-base font-bold text-sc-orange">US.</p>
          {{
            $t("congratulations.completed_us", {
              user_stories: completedUserStoryCount,
            })
          }}
        </div>
        <div class="flex items-center gap-6">
          <SvgUserStoriesAccepted
            class="size-6 text-sc-orange"
            :font-controlled="false"
            filled
          />
          {{
            $t("congratulations.completed_sp", {
              story_points: completedStoryPoints,
            })
          }}
        </div>
        <div class="flex items-center gap-6">
          <UIcon name="mingcute:chart-bar-line" class="text-sc-orange" />
          {{
            $t("congratulations.velocity", {
              velocity: velocity,
            })
          }}
        </div>
      </div>
    </div>
    <small class="w-2/5">
      <ClientOnly>
        <i18n-t
          keypath="congratulations.annotation.text"
          tag="p"
          class="text-center"
          scope="global"
        >
          <template #email_link>
            <a
              href="mailto:lisa-marie.hoermann@scrumplicity.app"
              class="text-sc-orange underline"
              >{{ $t("congratulations.annotation.email") }}</a
            >
          </template>
        </i18n-t>
      </ClientOnly>
    </small>
  </div>
</template>
