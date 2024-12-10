<script setup>
const localeRoute = useLocaleRoute();
</script>

<template>
  <footer class="flex w-full flex-wrap px-6 lg:justify-center lg:gap-[248px]">
    <div class="mx-4 mb-5">
      <h4 class="text-sm font-bold lg:text-2xl">
        {{ $t("common.brand_name") }}
      </h4>
      <p class="text-xs leading-6 lg:text-base">
        {{ $t("homepage.scrum_guide") }}
        <br />
        <NuxtLink
          to="https://diplomarbeit.scrumplicity.app/"
          target="_blank"
          external
          >{{ $t("homepage.diploma_thesis_website") }}</NuxtLink
        >
        <br />
        {{ $t("homepage.crafting_templates_download") }}
      </p>
    </div>
    <div class="mx-4 mb-5">
      <h4 class="text-sm font-bold lg:text-2xl">
        {{ $t("common.legal_matters") }}
      </h4>
      <NuxtLink :to="localeRoute('legal_notice')" class="text-xs lg:text-base">
        {{ $t("common.legal_notice") }}
      </NuxtLink>
    </div>
    <div class="mx-4">
      <h4 class="text-sm font-bold lg:text-2xl">
        {{ $t("socials.social_media") }}
      </h4>
      <p class="text-xs leading-6 lg:text-base">
        <NuxtLink
          to="https://www.instagram.com/scrumplicity.app"
          target="_blank"
          external
          >{{ $t("socials.instagram") }}</NuxtLink
        >
        <br />
        <NuxtLink
          to="https://www.facebook.com/people/Scrumplicityapp/61568992263197/"
          target="_blank"
          external
        >
          {{ $t("socials.facebook") }}</NuxtLink
        >
      </p>
    </div>
  </footer>
</template>
