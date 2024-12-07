<script lang="ts" setup>
const isMobileDevice = ref(false);
const mobileMenuOpen = ref(false);

onMounted(() => {
  if (/mobile/i.test(navigator.userAgent)) {
    isMobileDevice.value = true;
  }
});
</script>
<template>
  <div
    v-if="isMobileDevice"
    class="fixed top-12 z-50 flex w-screen justify-center"
  >
    <UNotification
      id="mobileDevice"
      class="w-[90vw]"
      icon="akar-icons:circle-alert"
      :title="$t('homepage.notification.title')"
      :description="$t('homepage.notification.description')"
      :timeout="0"
      :close-button="null"
    />
  </div>
  <USlideover v-model="mobileMenuOpen" :ui="{ width: 'max-w-[70vw]' }">
    <div class="flex flex-col items-end">
      <UButton
        color="gray"
        variant="ghost"
        size="sm"
        icon="i-heroicons-x-mark-20-solid"
        class="absolute right-1 top-1 z-10"
        square
        padded
        @click="mobileMenuOpen = false"
      />
      <div class="mb-6 mr-3 mt-9 flex flex-row items-center gap-2">
        <button class="rounded-full p-1 hover:bg-sc-black-100">
          <SvgDownload :font-controlled="false" class="size-8" />
        </button>
        <ChangeLangButton class="w-8" />
      </div>
    </div>
    <div class="mx-6 flex flex-col text-sm">
      <NuxtLink class="mb-7 flex items-center justify-between"
        ><p>{{ $t("homepage.scrum_guide") }}</p>
        <Icon
          name="material-symbols:arrow-forward-ios-rounded"
          class="text-sc-black"
          size="18px"
      /></NuxtLink>
      <NuxtLink
        class="mb-7 flex items-center justify-between"
        to="https://diplomarbeit.scrumplicity.app/"
        ><p>{{ $t("homepage.diploma_thesis_website") }}</p>
        <Icon
          name="material-symbols:arrow-forward-ios-rounded"
          class="text-sc-black"
          size="18px"
      /></NuxtLink>
      <NuxtLink class="flex items-center justify-between"
        ><p>{{ $t("homepage.crafting_templates_download") }}</p>
        <Icon
          name="material-symbols:arrow-forward-ios-rounded"
          class="text-sc-black"
          size="18px"
      /></NuxtLink>
    </div>
    <div class="ml-4 mt-10 flex flex-col gap-1">
      <p>{{ $t("homepage.follow_us") }}</p>
      <div>
        <NuxtLink
          to="https://www.instagram.com/scrumplicity.app"
          external
          target="_blank"
        >
          <Icon name="mdi:instagram" class="text-sc-black" size="28px" />
        </NuxtLink>
        <NuxtLink
          to="https://www.facebook.com/people/Scrumplicityapp/61568992263197/"
          external
          target="_blank"
        >
          <Icon name="ri:facebook-box-line" class="text-sc-black" size="28px" />
        </NuxtLink>
      </div>
    </div>
  </USlideover>
  <div class="absolute top-10 w-screen bg-sc-white px-4 lg:top-16 lg:px-[61px]">
    <SvgHomepageMobileBackground
      class="h-full w-full sm:hidden"
      :fontControlled="false"
      filled
    />
    <SvgHomepageDesktopBackground
      class="hidden h-full w-full sm:block"
      :fontControlled="false"
      filled
    />
  </div>
  <div class="relative flex flex-col">
    <header
      class="fixed z-30 flex h-10 w-screen bg-sc-white p-3 drop-shadow-sc-shadow lg:h-16"
    >
      <div class="ml-3 flex flex-grow items-center justify-between">
        <SvgMainLogo class="h-full w-auto" :fontControlled="false" filled />
        <UButton @click="mobileMenuOpen = !mobileMenuOpen" variant="ghost">
          <template #leading>
            <UIcon
              name="ic:round-menu"
              class="text-sc-black lg:hidden"
              size="20px"
          /></template>
        </UButton>
        <div class="hidden items-center gap-6 lg:flex">
          <NuxtLink>{{ $t("homepage.scrum_guide") }}</NuxtLink>
          <NuxtLink
            to="https://diplomarbeit.scrumplicity.app/"
            target="_blank"
            class=""
            >{{ $t("homepage.about_us") }}</NuxtLink
          >
          <UButton
            class="hidden h-8 drop-shadow-sc-shadow hover:bg-orange-700 lg:block"
            >{{ $t("homepage.get_started") }}</UButton
          >
          <div class="ml-6 hidden items-center gap-3 lg:flex">
            <UButton
              class="hover:bg-sc-black-100"
              variant="ghost"
              color="black"
              :padded="true"
              :ui="{
                padding: { sm: 'p-[0.15em]' },
                rounded: 'rounded-full',
              }"
            >
              <SvgDownload :font-controlled="false" class="h-10 w-10" />
            </UButton>
            <ChangeLangButton class="w-11" />
          </div>
        </div>
      </div>
    </header>
    <div class="mt-28 flex flex-col items-center lg:mt-16 lg:items-start">
      <div class="m-10 h-56 lg:ml-28 lg:mt-32">
        <SvgMainLogo
          class="w-[70vw] max-w-[650px]"
          :fontControlled="false"
          filled
        />
        <p
          class="my-3 max-w-[835px] bg-sc-white/70 text-left text-sm lg:text-2xl"
        >
          <span v-html="$t('homepage.project_description')"></span>
          <b>{{ $t("homepage.build_your_scrum_knowledge") }}</b>
        </p>
        <UButton
          class="hidden drop-shadow-sc-shadow hover:bg-orange-700 lg:block lg:px-10 lg:py-3 lg:text-2xl lg:font-bold"
          >{{ $t("homepage.get_started") }}</UButton
        >
        <UTooltip :text="$t('tooltip.not_available')">
          <UButton
            :disabled="true"
            class="drop-shadow-sc-shadow hover:bg-orange-700 lg:hidden"
            >{{ $t("homepage.scrum_guide") }}</UButton
          ></UTooltip
        >
      </div>
      <div
        class="mt-14 flex min-h-[700px] w-screen flex-col items-center lg:mt-80 lg:min-h-0"
      >
        <h2
          class="mb-5 bg-sc-white/70 font-heading text-xl font-bold text-sc-orange lg:mb-16 lg:text-6xl"
        >
          {{ $t("homepage.build_your_scrum_knowledge") }}
        </h2>
        <div class="lg:flex lg:flex-row lg:gap-16">
          <div
            class="mb-6 w-52 rounded-lg border-2 border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow lg:w-80"
          >
            <h3 class="font-heading text-xl lg:mb-3 lg:text-3xl">
              {{ $t("homepage.features.learn_scrum.title") }}
            </h3>
            <p class="text-xs lg:text-xl">
              {{ $t("homepage.features.learn_scrum.description") }}
            </p>
            <div class="flex justify-end">
              <SvgScrumProcessIllustration
                class="h-16 lg:h-28"
                :fontControlled="false"
                filled
              />
            </div>
          </div>
          <div
            class="mb-6 w-52 rounded-lg border-2 border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow lg:w-80"
          >
            <h3 class="font-heading text-xl lg:mb-3 lg:text-3xl">
              {{ $t("homepage.features.craft_your_city.title") }}
            </h3>
            <p class="text-xs lg:mb-6 lg:text-xl">
              {{ $t("homepage.features.craft_your_city.description") }}
            </p>
            <div class="flex justify-end">
              <SvgCraftingTemplateIllustration
                class="h-16 lg:h-28"
                :fontControlled="false"
                filled
              />
            </div>
          </div>
          <div
            class="w-52 rounded-lg border-2 border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow lg:mb-6 lg:w-80"
          >
            <h3 class="font-heading text-xl lg:mb-3 lg:text-3xl">
              {{ $t("homepage.features.solidify_teamwork.title") }}
            </h3>
            <p class="text-xs lg:text-xl">
              {{ $t("homepage.features.solidify_teamwork.description") }}
            </p>
            <div class="flex justify-end">
              <SvgTeamworkIllustration
                class="h-16 lg:h-28"
                :fontControlled="false"
                filled
              />
            </div>
          </div>
        </div>
      </div>
      <div
        class="mx-10 mt-20 min-h-[350px] lg:ml-56 lg:mt-60 lg:max-w-[1100px]"
      >
        <h3
          class="mb-2 bg-sc-white/70 font-heading text-sm font-bold text-sc-black-700 lg:text-2xl"
        >
          {{ $t("homepage.learning_materials") }}
        </h3>
        <h4
          class="mb-6 bg-sc-white/70 font-heading text-xl font-bold text-sc-orange lg:text-6xl"
        >
          {{ $t("homepage.all_you_need_to_know") }}
        </h4>
        <p
          class="mb-4 bg-sc-white/70 text-sm lg:mb-6 lg:text-2xl"
          v-html="$t('homepage.scrum_guide_description')"
        ></p>
        <UTooltip :text="$t('tooltip.not_available')">
          <UButton
            :disabled="true"
            class="drop-shadow-sc-shadow hover:bg-orange-700 lg:px-10 lg:py-3 lg:text-2xl lg:font-bold"
            >{{ $t("homepage.scrum_guide") }}</UButton
          ></UTooltip
        >
      </div>
      <div
        class="mx-10 mb-14 mt-24 text-right lg:mx-0 lg:mb-72 lg:mt-72 lg:w-screen lg:pl-96 lg:pr-48"
      >
        <h5
          class="bg-sc-white/70 font-heading text-xl font-bold text-sc-orange lg:mb-7 lg:text-6xl"
        >
          {{ $t("homepage.questions") }}
        </h5>
        <p class="mb-5 bg-sc-white/70 text-sm lg:mb-7 lg:text-2xl">
          {{ $t("homepage.here_to_help") }}
        </p>
        <a href="mailto:lisa-marie.hoermann@scrumplicity.app">
          <UButton
            class="drop-shadow-sc-shadow hover:bg-orange-700 lg:px-10 lg:py-3 lg:text-2xl lg:font-bold"
          >
            {{ $t("homepage.contact_us") }}</UButton
          ></a
        >
      </div>
    </div>
    <HomeFooter />
  </div>
</template>
