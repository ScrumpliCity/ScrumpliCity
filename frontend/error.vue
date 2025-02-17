<script setup lang="ts">
import type { NuxtError } from "#app";

const props = defineProps({
  error: Object as () => NuxtError,
});

const runtimeConfig = useRuntimeConfig();
const mail = runtimeConfig.public.contactMail;
</script>

<template>
  <div class="relative flex h-svh w-full items-start justify-start bg-sc-white">
    <NuxtLinkLocale
      to="/"
      class="absolute left-7 top-7 z-50 h-5 rounded bg-sc-white ring-4 ring-sc-white lg:left-10"
    >
      <SvgMainLogo :font-controlled="false" class="h-full lg:top-6 lg:h-8" />
    </NuxtLinkLocale>

    <div
      class="relative z-20 mx-9 mt-20 flex flex-col items-start gap-6 *:rounded-lg *:bg-sc-white/80 *:ring-8 *:ring-sc-white/80 sm:mx-12 sm:mt-24 lg:mx-20 lg:gap-8"
    >
      <h1 class="font-heading text-5xl font-bold leading-[0] text-sc-orange">
        <span class="leading-tight">{{ $t("error.error") }}</span
        ><br class="sm:hidden" />
        <span class="text-3xl sm:text-5xl"
          >{{ $t("error.plan_missing") }}
        </span>
      </h1>
      <p
        class="max-w-[48rem] text-sm text-sc-black sm:text-base lg:text-2xl lg:leading-relaxed"
      >
        <!-- if 404 error: display nice message; else: display the error message, if there is one -->
        {{ $t("error.description") }}
        <template v-if="props.error?.statusCode === 404">
          {{ $t("error.404_description") }}
        </template>
        <template
          v-else-if="props.error?.message || props.error?.statusMessage"
        >
          <br />
          <span
            class="rounded-sm bg-sc-black-50 font-mono ring-4 ring-sc-black-50"
            >{{ props.error?.message || props.error?.statusMessage }}</span
          >
        </template>
      </p>
      <div
        class="flex flex-col gap-2 text-sm sm:text-base lg:gap-3 lg:text-2xl"
      >
        <p class="font-semibold">{{ $t("error.do_now") }}</p>
        <div
          class="ml-3 flex flex-col gap-2 text-sc-orange sm:gap-3 lg:gap-4 lg:text-xl"
        >
          <NuxtLinkLocale to="/">{{
            $t("error.back_homepage")
          }}</NuxtLinkLocale>
          <NuxtLinkLocale to="scrumplicity-guide" class="lg:hidden">{{
            $t("error.scrum_guide")
          }}</NuxtLinkLocale>
          <NuxtLinkLocale to="role" class="hidden lg:block">{{
            $t("error.get_started")
          }}</NuxtLinkLocale>
          <div>
            <a :href="`mailto:${mail}`">{{ $t("error.contact_us") }}</a>
            <br class="lg:hidden" />
            <span class="text-sc-black"> – {{ $t("error.we_help") }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- positioned to be on the sign in the SVG -->
    <p
      class="absolute bottom-[18.9vw] left-[9.5vw] z-10 hidden w-[7vw] -translate-x-1/2 translate-y-1/2 text-center text-[1.3vw] font-bold leading-[1em] text-sc-black-800 xs:block sm:bottom-[13.45vw] sm:left-[41.2vw] sm:w-[4.6vw] sm:text-[0.9vw] lg:bottom-[11.8vw] lg:left-[49.8vw] lg:w-[3.8vw] lg:text-[0.75vw]"
    >
      {{ $t("error.do_not_enter") }}
    </p>

    <SvgErrorPageBackground
      filled
      :font-controlled="false"
      class="absolute -left-[110vw] -right-[2vw] bottom-[3vw] xs:-left-[80vw] xs:right-0 sm:-left-[17vw] lg:left-0"
    >
    </SvgErrorPageBackground>
  </div>
</template>
