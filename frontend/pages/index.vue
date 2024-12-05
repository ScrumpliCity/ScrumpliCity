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
      <div class="my-10 mr-3 flex flex-row">
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
        <ChangeLangButton class="w-10" />
      </div>
    </div>
    <div class="mx-6 flex flex-col text-sm">
      <NuxtLink class="mb-7 flex items-center justify-between"
        ><p>Scrum Guide</p>
        <Icon
          name="material-symbols:arrow-forward-ios-rounded"
          class="text-sc-black"
          size="18px"
      /></NuxtLink>
      <NuxtLink
        class="mb-7 flex items-center justify-between"
        to="https://diplomarbeit.scrumplicity.app/"
        ><p>Diplomarbeits-Webseite</p>
        <Icon
          name="material-symbols:arrow-forward-ios-rounded"
          class="text-sc-black"
          size="18px"
      /></NuxtLink>
      <NuxtLink
        class="flex items-center justify-between"
        to="https://diplomarbeit.scrumplicity.app/"
        ><p>Bastelvorlagen-Download</p>
        <Icon
          name="material-symbols:arrow-forward-ios-rounded"
          class="text-sc-black"
          size="18px"
      /></NuxtLink>
    </div>
    <div class="ml-4 mt-10 flex flex-col gap-1">
      <p>Folge uns!</p>
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
    <header
      class="lg:h16 flex h-10 bg-sc-white p-3 drop-shadow-sc-shadow lg:h-16"
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
          <NuxtLink to="/" class="">Scrum Guide</NuxtLink>
          <NuxtLink
            to="https://diplomarbeit.scrumplicity.app/"
            target="_blank"
            class=""
            >Über uns</NuxtLink
          >
          <UButton
            class="hidden h-8 drop-shadow-sc-shadow hover:bg-orange-700 lg:block"
            >Loslegen!</UButton
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
        <p class="my-3 bg-sc-white/70 text-left text-sm">
          Lerne die agile Projektmanagement&shy;methode Scrum mittels Bau einer
          Papierstadt! ScrumpliCity stellt eine Web-Applikation, Bastelvorlagen
          und Erklärungen zu Scrum zur Verfügung - also:
          <b>Build Your Scrum Knowledge</b>
        </p>
        <UButton
          class="hidden drop-shadow-sc-shadow hover:bg-orange-700 lg:block"
          >Loslegen!</UButton
        >
        <UTooltip text="Noch nicht verfügbar, komm später wieder! :)">
          <UButton
            :disabled="true"
            class="drop-shadow-sc-shadow hover:bg-orange-700 lg:hidden"
            >Scrum Guide</UButton
          ></UTooltip
        >
      </div>
      <div class="mt-14 flex flex-col items-center">
        <h2
          class="mb-5 bg-sc-white/70 font-heading text-xl font-bold text-sc-orange"
        >
          Build Your Scrum Knowledge!
        </h2>
        <div
          class="mb-6 h-[200px] w-52 rounded-lg border-2 border-sc-black bg-sc-black-50 p-4 drop-shadow-sc-shadow"
        >
          <h3 class="text-xl">Lerne Scrum</h3>
          <p class="text-xs">
            Entdecke die Grundlagen von Scrum und starte dein erstes agiles
            Projekt - praxisnah, interaktiv und einfach verständlich!
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
          <h3 class="text-xl">Bastle deine Stadt</h3>
          <p class="text-xs">
            Gestalte deine eigene Stadt aus Papier und erwecke Schritt für
            Schritt dein Projekt zum Leben!
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
          <h3 class="text-xl">Festige Teamwork</h3>
          <p class="text-xs">
            Stärke den Teamgeist und erlebe, wie effektive, kooperative
            Zusammenarbeit deine Projekte zum Erfolg führen!
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
          Lernunterlagen
        </h3>
        <h4
          class="mb-6bg-sc-white/70 font-heading text-xl font-bold text-sc-orange"
        >
          Scrum: Alles was du wissen musst!
        </h4>
        <p class="mb-4 bg-sc-white/70 text-sm">
          Du möchtest dich außerhalb des Spielprozesses über die agile
          Projektmanagement&shy;methode Scrum weiterbilden? Auf unserer
          Scrum-Theorie-Seite findest du alles Wichtige: von den Grundlagen bis
          zu praktischen Tipps. Egal, ob du neu einsteigst oder dein Wissen
          vertiefen möchtest - hier bekommst du klare, verständliche
          Erklärungen. Schau vorbei und bring deine Projekte auf das nächste
          Level!
        </p>
        <UTooltip text="Noch nicht verfügbar, komm später wieder! :)">
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
          Noch Fragen?
        </h5>
        <p class="mb-5 bg-sc-white/70 text-sm">
          Wir sind da um dir zu helfen! Schreib uns gerne eine E-Mail:
        </p>
        <a href="mailto:lisa-marie.hoermann@scrumplicity.app">
          <UButton class="drop-shadow-sc-shadow hover:bg-orange-700"
            >Kontaktiere uns!</UButton
          ></a
        >
      </div>
    </div>
    <HomeFooter />
  </div>
</template>
