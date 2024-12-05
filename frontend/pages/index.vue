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
      <NuxtLink
        class="flex items-center justify-between"
        to="https://diplomarbeit.scrumplicity.app/"
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
  <div class="absolute top-10 w-screen bg-sc-white px-4 lg:top-16">
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
    <header class="flex h-10 bg-sc-white p-3 drop-shadow-sc-shadow lg:h-16">
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
            <ChangeLangButton />
          </div>
        </div>
      </div>
    </header>
    <div class="flex flex-col items-center">
      <div class="m-10">
        <SvgMainLogo class="w-[70vw]" :fontControlled="false" filled />
        <div class="my-3 bg-sc-white/70 text-left text-sm">
          <p v-html="$t('homepage.project_description')"></p>
          <b>{{ $t("homepage.build_your_scrum_knowledge") }}</b>
        </div>
        <UButton
          class="hidden drop-shadow-sc-shadow hover:bg-orange-700 lg:block"
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
      <div class="mt-14 flex flex-col items-center">
        <h2
          class="mb-5 bg-sc-white/70 font-heading text-xl font-bold text-sc-orange"
        >
          {{ $t("homepage.build_your_scrum_knowledge") }}
        </h2>
        <div
          class="mb-6 h-[200px] w-52 rounded-lg border-2 border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow"
        >
          <h3 class="text-xl">
            {{ $t("homepage.features.learn_scrum.title") }}
          </h3>
          <p class="text-xs">
            {{ $t("homepage.features.learn_scrum.description") }}
          </p>
          <div class="flex justify-end">
            <SvgScrumProcessIllustration
              class="top-24 h-16"
              :fontControlled="false"
              filled
            />
          </div>
        </div>
        <div
          class="mb-6 h-[200px] w-52 rounded-lg border-2 border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow"
        >
          <h3 class="text-xl">
            {{ $t("homepage.features.craft_your_city.title") }}
          </h3>
          <p class="text-xs">
            {{ $t("homepage.features.craft_your_city.description") }}
          </p>
          <div class="flex justify-end">
            <SvgCraftingTemplateIllustration
              class="top-24 h-16"
              :fontControlled="false"
              filled
            />
          </div>
        </div>
        <div
          class="h-[200px] w-52 rounded-lg border-2 border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow"
        >
          <h3 class="text-xl">
            {{ $t("homepage.features.solidify_teamwork.title") }}
          </h3>
          <p class="text-xs">
            {{ $t("homepage.features.solidify_teamwork.description") }}
          </p>
          <div class="flex justify-end">
            <SvgTeamworkIllustration
              class="top-24 h-16"
              :fontControlled="false"
              filled
            />
          </div>
        </div>
      </div>
      <div class="mx-10 mt-16">
        <h3
          class="mb-2 bg-sc-white/70 font-heading text-sm font-bold text-sc-black-700"
        >
          {{ $t("homepage.learning_materials") }}
        </h3>
        <h4
          class="mb-6bg-sc-white/70 font-heading text-xl font-bold text-sc-orange"
        >
          {{ $t("homepage.all_you_need_to_know") }}
        </h4>
        <p
          class="mb-4 bg-sc-white/70 text-sm"
          v-html="$t('homepage.scrum_guide_description')"
        ></p>
        <UTooltip :text="$t('tooltip.not_available')">
          <UButton
            :disabled="true"
            class="drop-shadow-sc-shadow hover:bg-orange-700"
            >Scrum Guide</UButton
          ></UTooltip
        >
      </div>
      <div class="mx-10 mb-14 mt-28 text-right">
        <h5
          class="bg-sc-white/70 font-heading text-xl font-bold text-sc-orange"
        >
          {{ $t("homepage.questions") }}
        </h5>
        <p class="mb-5 bg-sc-white/70 text-sm">
          {{ $t("homepage.here_to_help") }}
        </p>
        <a href="mailto:lisa-marie.hoermann@scrumplicity.app">
          <UButton class="drop-shadow-sc-shadow hover:bg-orange-700">
            {{ $t("homepage.contact_us") }}</UButton
          ></a
        >
      </div>
    </div>
    <HomeFooter />
  </div>
</template>
