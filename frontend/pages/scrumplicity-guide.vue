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
    class="flex h-fit min-h-screen flex-col bg-[url('/assets/svg/LegalNoticeDesktopBackground.svg')] bg-cover bg-[bottom_2rem_left_2rem] bg-no-repeat text-justify"
  >
    <div
      class="mb-[10vh] mt-32 flex w-[76.547vw] flex-col gap-2 self-center font-sans"
    >
      <h1 class="mb-8 font-heading text-6xl font-bold text-sc-orange">
        {{ $t("scrumplicity_guide.title") }}
      </h1>
      <div class="mb-5 flex flex-row items-center justify-between">
        <div class="flex-1 flex-col">
          <p class="mb-5 text-lg font-medium">
            {{ $t("scrumplicity_guide.overview") }}
          </p>
          <p class="mb-3 font-heading text-3xl font-bold text-sc-orange">
            {{ $t("scrumplicity_guide.introduction.title") }}
          </p>
          <p class="text-lg font-medium">
            {{ $t("scrumplicity_guide.introduction.description") }}
          </p>
        </div>
        <SvgTutorSm class="ml-40 h-52 w-auto" :fontControlled="false" filled />
      </div>
      <div class="mb-5 flex flex-row items-center justify-between">
        <div class="flex-1 flex-col">
          <p class="mb-3 font-heading text-3xl font-bold text-sc-orange">
            {{ $t("scrumplicity_guide.prerequisites.title") }}
          </p>
          <p class="text-lg font-medium">
            {{ $t("scrumplicity_guide.prerequisites.description") }}
          </p>
        </div>
        <SvgCraftingTemplateIllustration
          class="ml-[90px] h-28 w-auto"
          :fontControlled="false"
          filled
        />
      </div>
      <p class="mb-3 font-heading text-3xl font-bold text-sc-orange">
        {{ $t("scrumplicity_guide.scrum_content.title") }}
      </p>
      <div class="mb-32 flex">
        <p class="flex-1 text-lg font-medium">
          NOCH BROKEN
          {{ $t("scrumplicity_guide.scrum_content.description") }}
        </p>
        <SvgScrumProcessIllustration
          class="float-right mb-[90px] ml-[90px] h-28 w-auto"
          :fontControlled="false"
          filled
        />
      </div>
      <h2
        class="mb-8 self-start font-heading text-5xl font-bold text-sc-orange"
      >
        {{ $t("scrumplicity_guide.step_by_step.title") }}
      </h2>
      <div class="mb-5 flex flex-row items-center justify-between">
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
        <p class="flex-1 text-base font-medium">
          <span class="font-heading text-6xl font-bold text-sc-orange">1.</span>
          {{ $t("scrumplicity_guide.step_by_step.description1") }}
        </p>
      </div>
      <div class="mb-5 flex flex-row items-center justify-between">
        <p class="flex-1 text-base font-medium">
          <span class="font-heading text-6xl font-bold text-sc-orange">2.</span>
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
      <div class="mb-5 flex flex-row items-center justify-between">
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
        <p class="flex-1 text-base font-medium">
          <span class="font-heading text-6xl font-bold text-sc-orange">3.</span>
          {{ $t("scrumplicity_guide.step_by_step.description3") }}
        </p>
      </div>
      <div class="mb-5 flex flex-row items-center justify-between">
        <p class="flex-1 text-base font-medium">
          <span class="font-heading text-6xl font-bold text-sc-orange">4.</span>
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
      <div class="mb-5 flex flex-row items-center justify-between">
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
        <p class="flex-1 text-base font-medium">
          <span class="font-heading text-6xl font-bold text-sc-orange">5.</span>
          {{ $t("scrumplicity_guide.step_by_step.description5") }}
        </p>
      </div>
      <div class="mb-32 flex flex-row items-center justify-between">
        <p class="flex-1 text-base font-medium">
          <span class="font-heading text-6xl font-bold text-sc-orange">6.</span>
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
        class="mb-8 self-start font-heading text-5xl font-bold text-sc-orange"
      >
        {{ $t("scrumplicity_guide.learners_title") }}
      </h3>
      <div class="mb-32 flex flex-row items-center justify-between">
        <i18n-t
          keypath="scrumplicity_guide.learners_description"
          tag="p"
          class="flex-1 text-lg font-medium"
          scope="global"
        >
          <template #join_steps>
            <ul class="ml-6 list-disc">
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
        <SvgLearnerSm
          class="ml-40 h-[188px] w-auto"
          :fontControlled="false"
          filled
        />
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
