<script lang="ts" setup>
const localeRoute = useLocaleRoute();
</script>

<template>
  <footer>
    <div
      class="flex w-screen flex-wrap px-6 min-[490px]:justify-center xl:gap-[248px]"
    >
      <div class="mx-4 bg-sc-white/70 max-[490px]:mb-5">
        <h4 class="text-sm font-bold xl:text-2xl">
          {{ $t("legal_notice.brand_name") }}
        </h4>
        <p class="text-xs leading-6 xl:text-base">
          {{ $t("homepage.scrum_guide") }}
          <br />
          <NuxtLink
            to="https://diplomarbeit.scrumplicity.app/"
            target="_blank"
            external
            class="transition-colors hover:text-sc-orange"
            >{{ $t("homepage.diploma_thesis_website") }}</NuxtLink
          >
          <br />
          {{ $t("homepage.crafting_templates_download") }}
        </p>
      </div>
      <div class="mx-4 bg-sc-white/70">
        <h4 class="text-sm font-bold xl:text-2xl">
          {{ $t("homepage.socials.social_media") }}
        </h4>
        <p class="text-xs leading-6 xl:text-base">
          <NuxtLink
            to="https://www.instagram.com/scrumplicity.app"
            target="_blank"
            external
            class="transition-colors hover:text-sc-orange"
            >{{ $t("homepage.socials.instagram") }}</NuxtLink
          >
          <br />
          <NuxtLink
            to="https://www.facebook.com/people/Scrumplicityapp/61568992263197/"
            target="_blank"
            external
            class="transition-colors hover:text-sc-orange"
          >
            {{ $t("homepage.socials.facebook") }}</NuxtLink
          >
        </p>
      </div>
      <div class="mx-4 bg-sc-white/70">
        <h4 class="text-sm font-bold xl:text-2xl">
          {{ $t("legal_notice.legal_matters") }}
        </h4>
        <NuxtLink
          :to="localeRoute('legal_notice')"
          class="text-xs transition-colors hover:text-sc-orange xl:text-base"
          >{{ $t("legal_notice.title") }}</NuxtLink
        >
      </div>
    </div>
    <div
      class="ml-[60vw] flex justify-end bg-sc-white pb-4 pr-4 font-heading text-xs xl:text-base"
    >
      <p>© 2024, ScrumpliCity</p>
    </div>
  </footer>
</template>
