<script lang="ts" setup>
import { useWindowScroll } from "@vueuse/core";
const localeRoute = useLocaleRoute();
const { t } = useI18n();
useSeoMeta({
  title: t("homepage.scrumplicity_guide"),
});

const { y } = useWindowScroll();

const scrollToTopOfPage = () => {
  y.value = 0;
};

const scrollToTopButtonIsVisible = computed(() => y.value > 200);
</script>

<template>
  <HomeHeader />
  <UButton
    @click="scrollToTopOfPage"
    v-show="scrollToTopButtonIsVisible"
    :ui="{ rounded: 'rounded-full' }"
    class="fixed bottom-5 right-5 z-50 flex size-12 items-center justify-center transition-colors hover:bg-orange-700 lg:size-16"
  >
    <UIcon name="mdi:arrow-up" size="100" class="bg-sc-black" />
  </UButton>
  <div class="h-fit w-full bg-sc-white">
    <div
      class="flex h-fit min-h-screen flex-col bg-[url('/assets/svg/ScrumpliCityGuideBackgroundSM.svg')] bg-cover bg-[bottom_1rem_left_1rem] bg-no-repeat text-justify lg:bg-[url('/assets/svg/ScrumpliCityGuideBackground.svg')] lg:bg-[bottom_2rem_left_2rem]"
    >
      <div
        class="mb-[20vh] mt-[104px] flex w-[76.547vw] flex-col gap-2 self-center font-sans lg:mt-32"
      >
        <h1
          class="mb-8 text-left font-heading text-3xl font-bold text-sc-orange sm:text-center md:text-4xl lg:text-5xl"
        >
          {{ $t("scrumplicity_guide.title") }}
        </h1>
        <div class="relative mb-5">
          <SvgTutorSm
            class="float-right mb-10 ml-[10vw] mt-10 h-[15vw] max-h-52 min-h-20 w-auto"
            :fontControlled="false"
            filled
          />
          <i18n-t
            keypath="scrumplicity_guide.overview"
            tag="p"
            class="mb-5 text-base font-medium md:text-lg"
            scope="global"
          >
            <template #link>
              <NuxtLink
                to="https://www.scrum.org/"
                target="_blank"
                external
                class="text-sc-orange underline"
              >
                {{ $t("scrumplicity_guide.link") }}
              </NuxtLink>
            </template>
          </i18n-t>
          <p
            class="mb-4 text-left font-heading text-xl font-bold text-sc-orange md:text-2xl lg:text-3xl"
          >
            {{ $t("scrumplicity_guide.introduction.title") }}
          </p>
          <p class="text-base font-medium md:text-lg">
            {{ $t("scrumplicity_guide.introduction.description") }}
          </p>
        </div>
        <div class="relative mb-5">
          <p
            class="mb-4 text-left font-heading text-xl font-bold text-sc-orange md:text-2xl lg:text-3xl"
          >
            {{ $t("scrumplicity_guide.prerequisites.title") }}
          </p>
          <SvgCraftingTemplateIllustration
            class="float-right mb-10 ml-[10vw] h-[10vw] max-h-28 min-h-20 w-auto"
            :fontControlled="false"
            filled
          />
          <p class="text-base font-medium md:text-lg">
            {{ $t("scrumplicity_guide.prerequisites.description") }}
          </p>
        </div>
        <div class="relative mb-16 lg:mb-32">
          <p
            class="mb-4 text-left font-heading text-xl font-bold text-sc-orange md:text-2xl lg:text-3xl"
          >
            {{ $t("scrumplicity_guide.scrum_content.title") }}
          </p>
          <SvgScrumProcessIllustration
            class="float-right mb-10 ml-[10vw] h-[10vw] max-h-28 min-h-20 w-auto"
            :fontControlled="false"
            filled
          />
          <p class="text-base font-medium md:text-lg">
            {{ $t("scrumplicity_guide.scrum_content.description") }}
          </p>
        </div>
        <h2
          class="mb-8 self-start text-left font-heading text-3xl font-bold text-sc-orange md:text-4xl lg:text-5xl"
        >
          {{ $t("scrumplicity_guide.step_by_step.title") }}
        </h2>
        <div class="mb-16 flex flex-col gap-16 min-[1200px]:gap-5">
          <GuideStep v-for="index in 6" :index="index" />
        </div>
        <h3
          class="mb-8 self-start text-left font-heading text-3xl font-bold text-sc-orange md:text-4xl lg:text-5xl"
        >
          {{ $t("scrumplicity_guide.learners_title") }}
        </h3>
        <div class="relative lg:mb-32">
          <SvgLearnerSm
            class="float-right mb-10 ml-[10vw] h-[15vw] max-h-52 min-h-20 w-auto"
            :fontControlled="false"
            filled
          />
          <i18n-t
            keypath="scrumplicity_guide.learners_description"
            tag="div"
            class="flex-1 bg-sc-white/70 text-base font-medium md:text-lg"
            scope="global"
          >
            <template #join_steps>
              <ul class="ml-6 list-disc text-left">
                <li v-for="index in 4">
                  {{ $t("scrumplicity_guide.join_steps.step" + index) }}
                </li>
              </ul>
            </template>
          </i18n-t>
        </div>
        <div class="flex w-full justify-center">
          <NuxtLink :to="localeRoute('role')">
            <UButton
              class="hidden !opacity-100 drop-shadow-sc-shadow hover:bg-sc-orange-700 lg:block lg:px-5 lg:py-2 lg:text-base lg:font-bold xl:text-xl"
              >{{ $t("scrumplicity_guide.get_started") }}</UButton
            ></NuxtLink
          >
        </div>
      </div>
    </div>
  </div>
</template>
