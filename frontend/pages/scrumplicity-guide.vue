<script setup></script>
<template>
  <HomeHeader />
  <div
    class="flex h-fit min-h-screen flex-col bg-[url('/assets/svg/LegalNoticeDesktopBackground.svg')] bg-cover bg-[bottom_2rem_left_2rem] bg-no-repeat"
  >
    <div
      class="mb-[10vh] mt-32 flex w-[76.547vw] flex-col gap-2 self-center bg-sc-white/70 font-sans"
    >
      <h1
        class="mb-8 font-heading text-6xl font-bold text-sc-orange lg:self-center lg:text-5xl"
      >
        {{ $t("scrumplicity_guide.title") }}
      </h1>
      <div class="mb-5 flex flex-row items-center justify-between">
        <div class="flex flex-col">
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
        <SvgTutorSm class="ml-40 h-52 w-full" :fontControlled="false" filled />
      </div>
      <div class="mb-5 flex flex-row items-center justify-between">
        <div class="flex flex-col">
          <p class="mb-3 font-heading text-3xl font-bold text-sc-orange">
            {{ $t("scrumplicity_guide.prerequisites.title") }}
          </p>
          <p class="text-lg font-medium">
            {{ $t("scrumplicity_guide.prerequisites.description") }}
          </p>
        </div>
        <SvgCraftingTemplateIllustration
          class="ml-[90px] h-28 w-full"
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
        class="mb-8 font-heading text-5xl font-bold text-sc-orange lg:self-center lg:text-5xl"
      >
        {{ $t("scrumplicity_guide.step_by_step.title") }}
      </h2>
    </div>
  </div>
</template>
