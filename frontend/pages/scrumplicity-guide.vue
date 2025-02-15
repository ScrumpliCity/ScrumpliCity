<script setup></script>
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
  <div
    class="flex h-fit min-h-screen flex-col bg-[url('/assets/svg/ScrumpliCityGuideBackgroundSM.svg')] bg-cover bg-[bottom_2rem_left_2rem] bg-no-repeat text-justify lg:bg-[url('/assets/svg/ScrumpliCityGuideBackground.svg')]"
  >
    <div
      class="mb-[20vh] mt-[104px] flex w-[76.547vw] flex-col gap-2 self-center font-sans lg:mt-32"
    >
      <h1
        class="mb-8 text-center font-heading text-3xl font-bold text-sc-orange md:text-4xl lg:text-5xl"
      >
        {{ $t("scrumplicity_guide.title") }}
      </h1>
      <div class="relative mb-5">
        <SvgTutorSm
          class="float-right mb-10 ml-[10vw] mt-10 h-auto max-h-[15vw] min-h-20 w-auto"
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
              external="true"
              class="text-sc-orange underline"
            >
              {{ $t("scrumplicity_guide.link") }}
            </NuxtLink>
          </template>
        </i18n-t>
        <p
          class="mb-3 text-left font-heading text-xl font-bold text-sc-orange md:text-2xl lg:text-3xl"
        >
          {{ $t("scrumplicity_guide.introduction.title") }}
        </p>
        <p class="text-base font-medium md:text-lg">
          {{ $t("scrumplicity_guide.introduction.description") }}
        </p>
      </div>
      <p
        class="mb-3 text-left font-heading text-xl font-bold text-sc-orange md:text-2xl lg:text-3xl"
      >
        {{ $t("scrumplicity_guide.prerequisites.title") }}
      </p>
      <div class="relative mb-5">
        <SvgCraftingTemplateIllustration
          class="float-right mb-10 ml-[10vw] h-auto max-h-[10vw] min-h-20 w-auto"
          :fontControlled="false"
          filled
        />
        <p class="text-base font-medium md:text-lg">
          {{ $t("scrumplicity_guide.prerequisites.description") }}
        </p>
      </div>
      <p
        class="mb-3 text-left font-heading text-xl font-bold text-sc-orange md:text-2xl lg:text-3xl"
      >
        {{ $t("scrumplicity_guide.scrum_content.title") }}
      </p>
      <div class="relative mb-16 lg:mb-32">
        <SvgScrumProcessIllustration
          class="float-right mb-10 ml-[10vw] h-auto max-h-[10vw] min-h-20 w-auto"
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
      <div class="mb-5 flex flex-row flex-wrap items-center justify-between">
        <div class="mr-12 flex h-auto w-[541px] flex-col">
          <img
            src="/assets/png/role_page.png"
            alt="Role Page"
            class="mb-2 drop-shadow-sc-shadow"
          />
          <p class="text-base font-medium text-sc-black-600">
            {{ $t("scrumplicity_guide.step_by_step.caption1") }}
          </p>
        </div>
        <p class="mt-5 min-w-[350px] flex-1 text-base font-medium">
          <span
            class="font-heading text-3xl font-bold text-sc-orange md:text-4xl lg:text-5xl"
            >1.</span
          >
          {{ $t("scrumplicity_guide.step_by_step.description1") }}
        </p>
      </div>
      <div
        class="mb-5 flex flex-row flex-wrap-reverse items-center justify-between"
      >
        <p class="min-w-[350px] flex-1 text-base font-medium">
          <span
            class="font-heading text-3xl font-bold text-sc-orange md:text-4xl lg:text-5xl"
            >2.</span
          >
          {{ $t("scrumplicity_guide.step_by_step.description2") }}
        </p>
        <div class="ml-12 flex h-auto w-[541px] flex-col">
          <img
            src="/assets/png/role_page.png"
            alt="Role Page"
            class="mb-2 drop-shadow-sc-shadow"
          />
          <p class="text-base font-medium text-sc-black-600">
            {{ $t("scrumplicity_guide.step_by_step.caption2") }}
          </p>
        </div>
      </div>
      <div class="mb-5 flex flex-row flex-wrap items-center justify-between">
        <div class="mr-12 flex h-auto w-[541px] flex-col">
          <img
            src="/assets/png/role_page.png"
            alt="Role Page"
            class="mb-2 drop-shadow-sc-shadow"
          />
          <p class="text-base font-medium text-sc-black-600">
            {{ $t("scrumplicity_guide.step_by_step.caption3") }}
          </p>
        </div>
        <p class="min-w-[350px] flex-1 text-base font-medium">
          <span
            class="font-heading text-3xl font-bold text-sc-orange md:text-4xl lg:text-5xl"
            >3.</span
          >
          {{ $t("scrumplicity_guide.step_by_step.description3") }}
        </p>
      </div>
      <div
        class="mb-5 flex flex-row flex-wrap-reverse items-center justify-between"
      >
        <p class="min-w-[350px] flex-1 text-base font-medium">
          <span
            class="font-heading text-3xl font-bold text-sc-orange md:text-4xl lg:text-5xl"
            >4.</span
          >
          {{ $t("scrumplicity_guide.step_by_step.description4") }}
        </p>
        <div class="ml-12 flex h-auto w-[541px] flex-col">
          <img
            src="/assets/png/role_page.png"
            alt="Role Page"
            class="mb-2 drop-shadow-sc-shadow"
          />
          <p class="text-base font-medium text-sc-black-600">
            {{ $t("scrumplicity_guide.step_by_step.caption4") }}
          </p>
        </div>
      </div>
      <div class="mb-5 flex flex-row flex-wrap items-center justify-between">
        <div class="mr-12 flex h-auto w-[541px] flex-col">
          <img
            src="/assets/png/role_page.png"
            alt="Role Page"
            class="mb-2 drop-shadow-sc-shadow"
          />
          <p class="text-base font-medium text-sc-black-600">
            {{ $t("scrumplicity_guide.step_by_step.caption5") }}
          </p>
        </div>
        <p class="min-w-[350px] flex-1 text-base font-medium">
          <span
            class="font-heading text-3xl font-bold text-sc-orange md:text-4xl lg:text-5xl"
            >5.</span
          >
          {{ $t("scrumplicity_guide.step_by_step.description5") }}
        </p>
      </div>
      <div
        class="mb-16 flex flex-row flex-wrap-reverse items-center justify-between lg:mb-32"
      >
        <p class="min-w-[350px] flex-1 text-base font-medium">
          <span
            class="font-heading text-3xl font-bold text-sc-orange md:text-4xl lg:text-5xl"
            >6.</span
          >
          {{ $t("scrumplicity_guide.step_by_step.description6") }}
        </p>
        <div class="ml-12 flex h-auto w-[541px] flex-col">
          <img
            src="/assets/png/role_page.png"
            alt="Role Page"
            class="mb-2 drop-shadow-sc-shadow"
          />
          <p class="text-base font-medium text-sc-black-600">
            {{ $t("scrumplicity_guide.step_by_step.caption6") }}
          </p>
        </div>
      </div>
      <h3
        class="mb-8 self-start text-left font-heading text-3xl font-bold text-sc-orange md:text-4xl lg:text-5xl"
      >
        {{ $t("scrumplicity_guide.learners_title") }}
      </h3>
      <div class="relative lg:mb-32">
        <SvgLearnerSm
          class="float-right mb-10 ml-[10vw] h-auto max-h-[10vw] min-h-20 w-auto"
          :fontControlled="false"
          filled
        />
        <i18n-t
          keypath="scrumplicity_guide.learners_description"
          tag="p"
          class="flex-1 text-base font-medium md:text-lg"
          scope="global"
        >
          <template #join_steps>
            <ul class="ml-6 list-disc text-left">
              <li>
                {{ $t("scrumplicity_guide.join_steps.step1") }}
              </li>
              <li>
                {{ $t("scrumplicity_guide.join_steps.step2") }}
              </li>
              <li>
                {{ $t("scrumplicity_guide.join_steps.step3") }}
              </li>
              <li>
                {{ $t("scrumplicity_guide.join_steps.step4") }}
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
</template>
<script lang="ts" setup>
import { useWindowScroll } from "@vueuse/core";
const localeRoute = useLocaleRoute();

const { y } = useWindowScroll();

const scrollToTopOfPage = () => {
  y.value = 0;
};

const scrollToTopButtonIsVisible = computed(() => y.value > 200);
</script>
