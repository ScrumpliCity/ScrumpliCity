<script setup>
definePageMeta({
  layout: "in-game",
  middleware: "ensure-playing",
});
import confetti from "canvas-confetti";
const game = useGameStore();
const { t, n } = useI18n();
const toast = useToast();
const isMounted = useMounted();
const runtimeConfig = useRuntimeConfig();
const mail = runtimeConfig.public.contactMail;

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
  const duration = 8000;
  const endTime = Date.now() + duration;
  const delay = 15;
  const headerOffset = 64 / window.innerHeight;
  const colorOptions = [["#CE6326"], ["#8CDBA4"], ["#E0AD49"]]; // ScrumpliCity colors: orange, green & yellow, respectively

  const randomInRange = (min, max) => Math.random() * (max - min) + min;

  const frame = () => {
    const timeLeft = endTime - Date.now();
    if (timeLeft <= 0) return;

    const ticks = Math.max(50, 500 * (timeLeft / duration));
    const colors =
      colorOptions[Math.floor(Math.random() * colorOptions.length)];

    if (!isMounted.value) return;

    confetti({
      particleCount: 1,
      startVelocity: 0,
      ticks: ticks,
      decay: 0.8,
      origin: {
        x: Math.random(),
        y: randomInRange(headerOffset, 0.6),
      },
      colors: colors,
      gravity: randomInRange(0.3, 0.5),
      scalar: randomInRange(0.4, 1.5),
      drift: randomInRange(-0.4, 0.4),
      disableForReducedMotion: true,
    });
    setTimeout(frame, delay);
  };

  frame();
}

function copyToClipboard() {
  const text = `
    # ${game.team.name}
    - ${t("congratulations.sprint", { n: game.team.room.number_of_sprints })}
    - ${t("congratulations.completed_us", { n: completedUserStoryCount })}
    - ${t("congratulations.completed_sp", { count: completedStoryPoints })}
    - ${t("congratulations.velocity", { velocity: n(Number(velocity.toFixed(2))) })}
  `.trim();
  navigator.clipboard.writeText(text);
  toast.add({
    title: t("congratulations.copy_success"),
    variant: "success",
  });
}
</script>
<template>
  <div
    class="mb-9 mt-12 flex h-[calc(100vh-150px)] flex-col items-center justify-center gap-6"
  >
    <h1 class="font-heading text-8xl font-bold">
      {{ t("congratulations.title") }}
    </h1>
    <h2 class="w-2/5 text-center text-2xl">
      {{ t("congratulations.subheading") }}
    </h2>
    <div
      class="mb-[3vw] flex h-full flex-col items-center justify-between gap-4"
    >
      <div
        class="relative z-10 flex w-[36vw] flex-col gap-3 rounded-[1.25rem] border-2 border-sc-black-400 px-6 py-5"
      >
        <h3 class="text-xl font-semibold">{{ game.team.name }}</h3>
        <UTooltip
          :text="t('congratulations.copy_tooltip')"
          class="absolute right-5 top-5"
        >
          <UButton
            icon="ic:baseline-content-copy"
            @click="copyToClipboard"
            class="text-sc-black-300"
            :ui="{ variant: 'icon', size: 'sm' }"
          ></UButton>
        </UTooltip>
        <hr class="mt-[2px] border border-sc-black-300" />

        <div class="ml-1.5 flex flex-col gap-4 text-xl">
          <div class="flex items-center gap-6">
            <SvgScrumProcessSMOrange :fontControlled="false" class="size-6" />
            {{
              $t("congratulations.sprint", {
                n: game.team.room.number_of_sprints,
              })
            }}
          </div>
          <div class="flex items-center gap-6">
            <p class="text-base font-bold text-sc-orange">
              {{ $t("congratulations.user_story_abbreviation") }}
            </p>
            {{
              $t("congratulations.completed_us", {
                n: completedUserStoryCount,
              })
            }}
          </div>
          <div class="flex items-center gap-6">
            <SvgUserStoriesAcceptedOrange
              class="size-6"
              :font-controlled="false"
            />
            {{
              $t("congratulations.completed_sp", {
                count: completedStoryPoints,
              })
            }}
          </div>
          <div class="flex items-center gap-6">
            <UIcon
              name="mingcute:chart-bar-line"
              class="size-6 text-sc-orange"
            />
            {{
              $t("congratulations.velocity", {
                velocity: $n(Number(velocity.toFixed(2))),
              })
            }}
          </div>
        </div>
      </div>
      <small class="z-10 w-3/5 justify-self-end">
        <i18n-t
          keypath="congratulations.annotation.text"
          tag="p"
          class="text-center"
          scope="global"
        >
          <template #email_link>
            <a :href="`mailto:${mail}`" class="text-sc-orange underline">{{
              $t("congratulations.annotation.email")
            }}</a>
          </template>
        </i18n-t>
      </small>
    </div>
  </div>
  <SvgCongratulationsBackground
    filled
    :fontControlled="false"
    class="absolute bottom-0 right-0 z-0"
  />
</template>
