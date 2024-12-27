<script lang="ts" setup>
const isMobileDevice = ref(false);

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
      class="w-[85vw]"
      color="sc-yellow"
      icon="akar-icons:circle-alert"
      :title="$t('homepage.notification.title')"
      :description="$t('homepage.notification.description')"
      :timeout="0"
      :close-button="null"
    />
  </div>
  <div
    class="absolute top-10 w-screen bg-sc-white px-[4.4vw] min-[440px]:-top-[5vw] min-[480px]:-top-[12vw] min-[500px]:-top-[16vw] min-[530px]:-top-[20vw] min-[550px]:-top-[22vw] min-[578px]:-top-[25vw] min-[600px]:-top-[27vw] sm:top-10 lg:top-16 lg:px-[61px]"
  >
    <SvgHomepageMobileBackground
      class="h-full w-full min-[480px]:hidden"
      :fontControlled="false"
      filled
    />
    <SvgHomepageMobileBackgroundShorterV2
      class="hidden h-full w-full min-[480px]:block sm:hidden"
      :fontControlled="false"
      filled
    />
    <SvgHomepageTabletBackground
      class="hidden h-full w-full sm:block"
      :fontControlled="false"
      filled
    />
    <SvgHomepageDesktopBackground
      class="hidden h-full w-full lg:block"
      :fontControlled="false"
      filled
    />
  </div>
  <div class="relative flex flex-col">
    <HomeHeader />
    <div class="mt-28 flex flex-col items-center lg:mt-16">
      <div class="m-10 h-56 min-[580px]:mr-32 sm:ml-14 lg:ml-28 lg:mt-32">
        <SvgMainLogo
          class="w-[70vw] sm:w-[300px]"
          :fontControlled="false"
          filled
        />
        <p
          class="my-3 max-w-[835px] bg-sc-white/70 text-left text-sm xs:text-base min-[460px]:text-lg lg:text-2xl"
        >
          <span v-html="$t('homepage.project_description')"></span>
          <b>{{ $t("homepage.build_your_scrum_knowledge") }}</b>
        </p>
        <UButton
          style="opacity: 100"
          class="hidden drop-shadow-sc-shadow hover:bg-orange-700 lg:block lg:px-10 lg:py-3 lg:text-2xl lg:font-bold"
          >{{ $t("homepage.get_started") }}</UButton
        >
        <UTooltip :text="$t('tooltip.not_available')">
          <UButton
            style="opacity: 100"
            :disabled="true"
            class="drop-shadow-sc-shadow hover:bg-orange-700 xs:text-base lg:hidden"
            >{{ $t("homepage.scrum_guide") }}</UButton
          ></UTooltip
        >
      </div>
      <div
        class="mt-14 flex min-h-[710px] w-screen flex-col items-center xs:mt-[25vw] min-[394px]:min-h-[705px] min-[400px]:min-h-[782px] min-[415px]:mt-[33vw] min-[455px]:mt-[40vw] min-[480px]:mt-[20vw] min-[480px]:min-h-[820px] min-[520px]:min-h-[872px] min-[570px]:mt-[33vw] sm:mt-[10vw] sm:min-h-[650px] lg:mt-80 lg:min-h-0"
      >
        <h2
          class="mb-5 bg-sc-white/70 font-heading text-xl font-bold text-sc-orange min-[480px]:text-2xl lg:mb-16 lg:text-6xl"
        >
          {{ $t("homepage.build_your_scrum_knowledge") }}
        </h2>
        <div
          class="flex flex-col justify-center gap-6 min-[490px]:gap-[6vw] sm:mx-10 sm:flex-row sm:flex-wrap"
        >
          <div
            class="w-52 max-w-[275px] rounded-lg border border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow min-[480px]:w-[55vw] sm:w-[224px] lg:w-80"
          >
            <h3
              class="font-heading text-xl min-[520px]:text-2xl sm:text-xl lg:mb-3 lg:text-3xl"
            >
              {{ $t("homepage.features.learn_scrum.title") }}
            </h3>
            <p
              class="text-xs min-[400px]:text-sm min-[480px]:text-base lg:text-xl"
            >
              {{ $t("homepage.features.learn_scrum.description") }}
            </p>
            <div class="flex justify-end">
              <SvgScrumProcessIllustration
                class="h-16 min-[520px]:h-20 sm:h-16 lg:h-28"
                :fontControlled="false"
                filled
              />
            </div>
          </div>
          <div
            class="w-52 max-w-[275px] rounded-lg border border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow min-[480px]:w-[55vw] sm:w-[224px] lg:w-80"
          >
            <h3
              class="font-heading text-xl min-[520px]:text-2xl lg:mb-3 lg:text-3xl"
            >
              {{ $t("homepage.features.craft_your_city.title") }}
            </h3>
            <p
              class="mb-1 text-xs min-[400px]:text-sm min-[480px]:text-base lg:mb-6 lg:text-xl"
            >
              {{ $t("homepage.features.craft_your_city.description") }}
            </p>
            <div class="flex justify-end">
              <SvgCraftingTemplateIllustration
                class="h-16 min-[520px]:h-20 sm:h-16 lg:h-28"
                :fontControlled="false"
                filled
              />
            </div>
          </div>
          <div
            class="w-52 max-w-[275px] rounded-lg border border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow min-[480px]:w-[55vw] sm:w-[224px] lg:mb-6 lg:w-80"
          >
            <h3
              class="font-heading text-xl min-[520px]:text-2xl lg:mb-3 lg:text-3xl"
            >
              {{ $t("homepage.features.solidify_teamwork.title") }}
            </h3>
            <p
              class="text-xs min-[400px]:text-sm min-[480px]:text-base lg:text-xl"
            >
              {{ $t("homepage.features.solidify_teamwork.description") }}
            </p>
            <div class="flex justify-end">
              <SvgTeamworkIllustration
                class="h-16 min-[520px]:h-20 sm:h-16 lg:h-28"
                :fontControlled="false"
                filled
              />
            </div>
          </div>
        </div>
      </div>
      <div class="w-screen">
        <div
          class="mx-[11vw] mt-[15vw] min-h-[370px] max-w-80 min-[377px]:mt-[30vw] min-[394px]:min-h-[420px] min-[400px]:mt-[24vw] min-[425px]:mt-[35vw] min-[440px]:mt-[25vw] min-[450px]:mt-[35vw] min-[470px]:mt-[45vw] min-[480px]:mt-[17vw] min-[480px]:min-h-[508px] min-[484px]:mt-[23vw] min-[504px]:mt-[30vw] min-[516px]:mt-[33vw] min-[540px]:mt-[40vw] min-[620px]:mt-[50vw] sm:mt-[0vw] sm:min-h-[308px] sm:max-w-none lg:ml-56 lg:mt-60 lg:max-w-[1100px]"
        >
          <h3
            class="mb-2 bg-sc-white/70 font-heading text-sm font-bold text-sc-black-700 min-[400px]:text-base min-[480px]:text-lg lg:text-2xl"
          >
            {{ $t("homepage.learning_materials") }}
          </h3>
          <h4
            class="mb-6 bg-sc-white/70 font-heading text-xl font-bold text-sc-orange min-[480px]:text-2xl sm:mb-2 lg:text-6xl"
          >
            {{ $t("homepage.all_you_need_to_know") }}
          </h4>
          <p
            class="mb-4 bg-sc-white/70 text-sm min-[394px]:text-base min-[480px]:text-lg sm:text-base lg:mb-6 lg:text-2xl"
            v-html="$t('homepage.scrum_guide_description')"
          ></p>
          <UTooltip :text="$t('tooltip.not_available')">
            <UButton
              :disabled="true"
              style="opacity: 100"
              class="drop-shadow-sc-shadow hover:bg-orange-700 lg:px-10 lg:py-3 lg:text-2xl lg:font-bold"
              >{{ $t("homepage.scrum_guide") }}</UButton
            ></UTooltip
          >
        </div>
      </div>
      <div
        class="mx-10 mb-16 mt-20 max-w-[475px] text-right xs:mb-[20vw] xs:mt-[23vw] min-[370px]:mt-[30vw] min-[400px]:mb-[25vw] min-[400px]:mt-[20vw] min-[410px]:mt-[27vw] min-[435px]:mt-[34vw] min-[470px]:mb-[45vw] min-[480px]:mb-[28vw] min-[480px]:mt-[13vw] min-[530px]:mt-[18vw] min-[600px]:mt-[30vw] sm:mb-[9vw] sm:mt-[7vw] lg:mx-0 lg:mb-64 lg:mt-72 lg:w-screen lg:pr-48"
      >
        <h5
          class="bg-sc-white/70 font-heading text-xl font-bold text-sc-orange min-[480px]:text-2xl lg:mb-7 lg:bg-none lg:text-6xl"
        >
          {{ $t("homepage.questions") }}
        </h5>
        <p
          class="mb-5 bg-sc-white/70 pl-20 text-sm min-[400px]:text-base min-[480px]:text-lg lg:mb-7 lg:bg-sc-white/0 lg:text-2xl"
        >
          {{ $t("homepage.here_to_help") }}
        </p>
        <a href="mailto:lisa-marie.hoermann@scrumplicity.app">
          <UButton
            style="opacity: 100"
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
