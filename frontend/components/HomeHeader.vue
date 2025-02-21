<script setup lang="ts">
const mobileMenuOpen = ref(false);
const localeRoute = useLocaleRoute();
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
        <DownloadFilesButton class="[&_svg]:size-8" />
        <ChangeLangButton class="w-8" />
      </div>
    </div>
    <div class="mx-6 flex flex-col gap-7 text-sm">
      <NuxtLink
        class="flex items-center justify-between transition-colors hover:text-sc-orange"
        :to="localeRoute('scrumplicity-guide')"
        ><p>{{ $t("homepage.scrumplicity_guide") }}</p>
        <Icon
          name="material-symbols:arrow-forward-ios-rounded"
          class="text-sc-black"
          size="18px"
      /></NuxtLink>
      <NuxtLink
        class="flex items-center justify-between transition-colors hover:text-sc-orange"
        to="https://diplomarbeit.scrumplicity.app/"
        target="_blank"
        ><p>{{ $t("homepage.diploma_thesis_website") }}</p>
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
          <Icon
            name="mdi:instagram"
            class="text-sc-black transition-colors hover:text-sc-orange"
            size="28px"
          />
        </NuxtLink>
        <NuxtLink
          to="https://www.facebook.com/people/Scrumplicityapp/61568992263197/"
          external
          target="_blank"
        >
          <Icon
            name="ri:facebook-box-line"
            class="text-sc-black transition-colors hover:text-sc-orange"
            size="28px"
          />
        </NuxtLink>
      </div>
    </div>
  </USlideover>
  <header
    class="fixed z-30 flex h-10 w-full bg-sc-white p-3 drop-shadow-sc-shadow lg:h-16"
  >
    <div class="ml-3 flex flex-grow items-center justify-between">
      <NuxtLinkLocale to="/">
        <SvgMainLogo
          class="h-4 w-auto lg:h-10"
          :fontControlled="false"
          filled
        />
      </NuxtLinkLocale>
      <UButton
        @click="mobileMenuOpen = !mobileMenuOpen"
        variant="ghost"
        class="lg:hidden"
      >
        <template #leading>
          <UIcon name="ic:round-menu" class="text-sc-black" size="20px"
        /></template>
      </UButton>
      <div class="hidden items-center gap-6 lg:flex">
        <NuxtLink
          :to="localeRoute('scrumplicity-guide')"
          class="transition-colors hover:text-sc-orange"
          >{{ $t("homepage.scrumplicity_guide") }}</NuxtLink
        >
        <NuxtLink
          to="https://diplomarbeit.scrumplicity.app/#team"
          target="_blank"
          class="transition-colors hover:text-sc-orange"
          >{{ $t("homepage.about_us") }}</NuxtLink
        >
        <NuxtLink :to="localeRoute('role')">
          <UButton
            class="hidden h-8 !opacity-100 drop-shadow-sc-shadow hover:bg-orange-700 lg:block"
            >{{ $t("homepage.get_started") }}</UButton
          ></NuxtLink
        >
        <div class="ml-6 hidden items-center gap-3 lg:flex">
          <DownloadFilesButton />
          <ChangeLangButton class="w-11" />
        </div>
      </div>
    </div>
  </header>
</template>
