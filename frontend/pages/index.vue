<script lang="ts" setup>
import { useWindowScroll } from "@vueuse/core";

const { y } = useWindowScroll();

const scrollToTopOfPage = () => {
  y.value = 0;
};

const scrollToTopButtonIsVisible = computed(() => y.value > 200);
</script>

<template>
  <ClientOnly>
    <div class="absolute top-12 z-10 flex w-screen justify-center lg:hidden">
      <!--@vue-expect-error ':close-button="null" is the way to hide the close button but incorrectly not allowed by types -->
      <UNotification
        id="mobileDevice"
        class="w-[85vw]"
        color="sc-yellow"
        icon="akar-icons:circle-alert"
        :title="$t('homepage.notification.title')"
        :description="$t('homepage.notification.description')"
        :timeout="0"
        :close-button="null"
      /></div
  ></ClientOnly>
  <UButton
    @click="scrollToTopOfPage"
    v-show="scrollToTopButtonIsVisible"
    :ui="{ rounded: 'rounded-full' }"
    class="fixed bottom-5 right-5 z-50 flex size-12 items-center justify-center transition-colors hover:bg-orange-700 lg:size-16"
  >
    <UIcon name="mdi:arrow-up" size="100" class="bg-sc-black" />
  </UButton>

  <div
    class="absolute top-10 w-full bg-sc-white px-[4.4vw] min-[440px]:-top-[5vw] min-[480px]:-top-[12vw] min-[500px]:-top-[16vw] min-[530px]:-top-[20vw] min-[550px]:-top-[22vw] min-[578px]:-top-[25vw] min-[600px]:-top-[27vw] sm:top-10 min-[684px]:-top-[5vw] min-[720px]:-top-[8vw] min-[760px]:-top-[11vw] min-[810px]:-top-[15vw] min-[900px]:-top-[18vw] min-[930px]:-top-[21vw] min-[1000px]:-top-[23vw] lg:top-10 min-[1120px]:-top-[3vw]"
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
      class="hidden h-full w-full sm:block md:hidden"
      :fontControlled="false"
      filled
    />
    <SvgHomepageTabletBackgroundShorter
      class="hidden h-full w-full md:block min-[855px]:hidden"
      :fontControlled="false"
      filled
    />
    <SvgHomepageTabletBackgroundKnowledgeRow
      class="hidden h-full w-full min-[855px]:block lg:hidden"
      :fontControlled="false"
      filled
    />
    <SvgHomepageDesktopBackground
      class="hidden h-full w-full lg:block"
      :fontControlled="false"
      filled
    />
  </div>
  <div class="relative flex flex-col overflow-hidden">
    <HomeHeader />
    <div class="mt-32 flex flex-col lg:mt-20 xl:mt-[8vw]">
      <div
        id="introduction"
        class="m-10 h-56 scroll-m-40 min-[580px]:mr-32 sm:ml-14 lg:ml-20 xl:ml-28 min-[1330px]:mr-[38vw]"
      >
        <SvgMainLogo
          class="w-[70vw] sm:w-[300px] md:w-[40vw] md:max-w-[450px] lg:max-w-[520px] xl:max-w-[590px]"
          :fontControlled="false"
          filled
        />
        <p
          class="my-3 max-w-[835px] bg-sc-white/70 text-left text-sm xs:text-base min-[460px]:text-lg lg:max-w-[60vw] min-[1190px]:text-xl min-[1330px]:text-2xl min-[1700px]:text-3xl"
        >
          <span>{{ $t("homepage.project_description") }}</span>
          <b>{{ $t("homepage.build_your_scrum_knowledge") }}</b>
        </p>
        <UTooltip :text="$t('homepage.tooltip.not_available')">
          <UButton
            :disabled="true"
            class="hidden !opacity-100 drop-shadow-sc-shadow hover:bg-orange-700 lg:block lg:px-5 lg:py-2 lg:text-base lg:font-bold xl:text-xl"
            >{{ $t("homepage.get_started") }}</UButton
          >
          <UButton
            :disabled="true"
            class="!opacity-100 drop-shadow-sc-shadow hover:bg-orange-700 xs:text-base lg:hidden"
            >{{ $t("homepage.scrum_guide") }}</UButton
          ></UTooltip
        >
      </div>
      <div
        id="knowledge"
        class="mt-10 flex min-h-[710px] w-screen flex-col items-center xs:mt-[25vw] min-[394px]:min-h-[705px] min-[400px]:min-h-[782px] min-[415px]:mt-[33vw] min-[455px]:mt-[40vw] min-[480px]:mt-[20vw] min-[480px]:min-h-[820px] min-[520px]:min-h-[872px] min-[570px]:mt-[33vw] sm:mt-[10vw] sm:min-h-[650px] min-[660px]:mt-[15vw] min-[684px]:mt-[10vw] min-[720px]:mt-[5vw] min-[855px]:mt-[3vw] min-[855px]:min-h-[350px] lg:mt-[15vw] xl:mt-[12vw] xl:min-h-[426px] min-[1400px]:mt-[15vw] min-[1400px]:min-h-[430px] min-[1600px]:mt-[20vw]"
      >
        <h2
          class="mb-5 bg-sc-white/70 font-heading text-xl font-bold text-sc-orange min-[480px]:text-2xl min-[720px]:mb-8 min-[720px]:text-3xl lg:text-4xl xl:mb-14 xl:text-5xl min-[1700px]:text-6xl"
        >
          {{ $t("homepage.build_your_scrum_knowledge") }}
        </h2>
        <div
          class="flex flex-col justify-center gap-6 min-[490px]:gap-[6vw] sm:mx-10 sm:flex-row sm:flex-wrap min-[855px]:gap-[4vw]"
        >
          <div
            class="w-52 rounded-lg border border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow max-[480px]:max-w-[275px] min-[480px]:w-[55vw] sm:w-[224px] lg:w-[260px] xl:w-72 min-[1400px]:w-80"
          >
            <h3
              class="font-heading text-xl min-[520px]:text-2xl xl:mb-3 xl:text-3xl min-[1400px]:text-4xl"
            >
              {{ $t("homepage.features.learn_scrum.title") }}
            </h3>
            <p
              class="text-xs min-[400px]:text-sm min-[480px]:text-base min-[855px]:min-h-[144px] lg:mb-1 lg:text-lg min-[1400px]:text-xl"
            >
              {{ $t("homepage.features.learn_scrum.description") }}
            </p>
            <div class="flex justify-end">
              <SvgScrumProcessIllustration
                class="h-16 min-[520px]:h-20 sm:h-16 xl:h-24"
                :fontControlled="false"
                filled
              />
            </div>
          </div>
          <div
            class="w-52 rounded-lg border border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow max-[480px]:max-w-[275px] min-[480px]:w-[55vw] sm:w-[224px] lg:w-[260px] xl:w-72 min-[1400px]:w-80"
          >
            <h3
              class="font-heading text-xl min-[520px]:text-2xl xl:mb-3 xl:text-3xl min-[1400px]:text-4xl"
            >
              {{ $t("homepage.features.craft_your_city.title") }}
            </h3>
            <p
              class="mb-1 text-xs min-[400px]:text-sm min-[480px]:text-base min-[640px]:min-h-[115px] min-[855px]:min-h-[144px] lg:text-lg min-[1400px]:text-xl"
            >
              {{ $t("homepage.features.craft_your_city.description") }}
            </p>
            <div class="flex justify-end">
              <SvgCraftingTemplateIllustration
                class="h-16 min-[520px]:h-20 sm:h-16 xl:h-24"
                :fontControlled="false"
                filled
              />
            </div>
          </div>
          <div
            class="w-52 rounded-lg border border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow max-[480px]:max-w-[275px] min-[480px]:w-[55vw] sm:w-[224px] lg:w-[260px] xl:w-72 min-[1400px]:w-80"
          >
            <h3
              class="font-heading text-xl min-[520px]:text-2xl xl:mb-3 xl:text-3xl min-[1400px]:text-4xl"
            >
              {{ $t("homepage.features.solidify_teamwork.title") }}
            </h3>
            <p
              class="text-xs min-[400px]:text-sm min-[480px]:text-base min-[855px]:min-h-[144px] lg:text-lg min-[1400px]:text-xl"
            >
              {{ $t("homepage.features.solidify_teamwork.description") }}
            </p>
            <div class="flex justify-end">
              <SvgTeamworkIllustration
                class="h-16 min-[520px]:h-20 sm:h-16 xl:h-24"
                :fontControlled="false"
                filled
              />
            </div>
          </div>
        </div>
      </div>
      <div class="w-screen">
        <div
          id="learning-materials"
          class="mx-[11vw] mt-[10vw] min-h-[370px] max-w-80 min-[377px]:mt-[30vw] min-[394px]:min-h-[420px] min-[400px]:mt-[24vw] min-[425px]:mt-[35vw] min-[440px]:mt-[25vw] min-[450px]:mt-[35vw] min-[470px]:mt-[45vw] min-[480px]:mt-[17vw] min-[480px]:min-h-[508px] min-[484px]:mt-[23vw] min-[504px]:mt-[30vw] min-[516px]:mt-[33vw] min-[540px]:mt-[35vw] min-[560px]:mt-[40vw] min-[620px]:mt-[50vw] sm:mt-[0vw] sm:min-h-[308px] sm:max-w-none min-[650px]:mt-[3vw] min-[675px]:mt-[6vw] min-[695px]:mt-[10vw] min-[730px]:mt-[12vw] min-[740px]:mt-[17vw] md:mt-[5vw] min-[790px]:mt-[10vw] min-[844px]:mt-[15vw] min-[855px]:mt-[2vw] min-[870px]:mt-[6vw] min-[970px]:mt-[12vw] lg:mt-[8vw] min-[1060px]:mt-[11vw] min-[1190px]:mt-[15vw] xl:mt-[10vw] xl:min-h-[392px] xl:max-w-[1170px] min-[1300px]:mt-[13vw] min-[1400px]:mt-[12vw] min-[1400px]:min-h-[375px] min-[1430px]:mt-[16vw] min-[1480px]:mt-[20vw] min-[1800px]:mt-[25vw]"
        >
          <h3
            class="mb-2 bg-sc-white/70 font-heading text-sm font-bold text-sc-black-700 min-[400px]:text-base min-[480px]:text-lg lg:text-xl xl:text-3xl"
          >
            {{ $t("homepage.learning_materials") }}
          </h3>
          <h4
            class="mb-6 bg-sc-white/70 font-heading text-xl font-bold text-sc-orange min-[480px]:text-2xl sm:mb-2 lg:text-4xl xl:text-6xl"
          >
            {{ $t("homepage.all_you_need_to_know") }}
          </h4>
          <p
            class="mb-4 bg-sc-white/70 text-sm min-[394px]:text-base min-[480px]:text-lg sm:text-base min-[720px]:text-lg lg:text-xl xl:text-2xl min-[1400px]:leading-10"
            v-html="$t('homepage.scrum_guide_description')"
          ></p>
          <UTooltip :text="$t('homepage.tooltip.not_available')">
            <UButton
              :disabled="true"
              class="!opacity-100 drop-shadow-sc-shadow hover:bg-orange-700 lg:px-5 lg:py-2 lg:text-base lg:font-bold xl:text-xl"
              >{{ $t("homepage.scrum_guide") }}</UButton
            ></UTooltip
          >
        </div>
      </div>
      <div class="flex w-screen flex-col items-end sm:px-[5vw]" id="contact">
        <div
          class="mx-10 mb-12 mt-12 max-w-[475px] text-right xs:mb-[19vw] xs:mt-[23vw] min-[370px]:mt-[30vw] min-[400px]:mb-[25vw] min-[400px]:mt-[20vw] min-[410px]:mt-[27vw] min-[435px]:mt-[34vw] min-[480px]:mb-[28vw] min-[480px]:mt-[13vw] min-[530px]:mt-[18vw] min-[550px]:mt-[25vw] min-[600px]:mt-[30vw] min-[610px]:mb-[30vw] sm:mb-[6vw] sm:mt-[7vw] min-[710px]:mb-[10vw] min-[720px]:mt-[12vw] md:mt-[10vw] min-[830px]:mb-[12vw] min-[830px]:mt-[15vw] min-[855px]:mt-[12vw] lg:mb-[13vw] min-[1050px]:mb-[16vw] min-[1060px]:mb-[13vw] min-[1078px]:mt-[15vw] min-[1100px]:mb-[15vw] min-[1120px]:mb-[10vw] min-[1244px]:mt-[20vw] min-[1250px]:mb-[13vw] xl:mt-[12vw] xl:max-w-none min-[1350px]:mb-[17vw] min-[1560px]:mb-[20vw] min-[1700px]:mb-[15vw] min-[1700px]:mt-[20vw] min-[1870px]:mb-[20vw] min-[1870px]:mt-[20vw]"
        >
          <h5
            class="bg-sc-white/70 font-heading text-xl font-bold text-sc-orange min-[480px]:text-2xl lg:text-4xl xl:mb-7 xl:text-6xl"
          >
            {{ $t("homepage.questions") }}
          </h5>
          <p
            class="mb-5 bg-sc-white/70 pl-20 text-sm min-[400px]:text-base min-[480px]:text-lg lg:text-xl xl:mb-7 xl:bg-sc-white/0 xl:text-2xl"
          >
            {{ $t("homepage.here_to_help") }}
          </p>
          <a href="mailto:lisa-marie.hoermann@scrumplicity.app">
            <UButton
              class="!opacity-100 drop-shadow-sc-shadow hover:bg-orange-700 lg:px-5 lg:py-2 lg:text-base lg:font-bold xl:text-xl"
            >
              {{ $t("homepage.contact_us") }}</UButton
            ></a
          >
        </div>
      </div>
    </div>
    <HomeFooter />
  </div>
</template>
