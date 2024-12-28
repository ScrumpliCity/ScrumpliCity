<script setup lang="ts">
const mobileMenuOpen = ref(false);
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
        target="_blank"
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
        <UTooltip :text="$t('tooltip.not_available')">
          <UButton
            :disabled="true"
            style="opacity: 100"
            class="hidden h-8 drop-shadow-sc-shadow hover:bg-orange-700 lg:block"
            >{{ $t("homepage.get_started") }}</UButton
          ></UTooltip
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
</template>
