<template>
  <footer class="flex w-screen flex-wrap px-10 lg:justify-center">
    <div class="mx-4 mb-5">
      <h4 class="text-sm font-bold">{{ $t("common.brand_name") }}</h4>
      <p class="text-xs leading-6">
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
      <h4 class="text-sm font-bold">{{ $t("common.legal_matters") }}</h4>
      <p class="text-xs">{{ $t("common.imprint") }}</p>
    </div>
    <div class="mx-4 mb-5">
      <h4 class="text-sm font-bold">{{ $t("socials.social_media") }}</h4>
      <p class="text-xs leading-6">
        {{ $t("socials.instagram") }} <br />
        {{ $t("socials.facebook") }}
      </p>
    </div>
  </footer>
</template>
