<template>
  <div class="absolute top-10 w-screen bg-sc-white px-4">
    <SvgHomepageMobileBackground
      class="h-full w-full overflow-y-scroll"
      :fontControlled="false"
      filled
    />
  </div>
  <div class="relative flex flex-col">
    <header class="flex h-10 bg-sc-white p-3 drop-shadow-sc-shadow lg:h-16">
      <div class="ml-3 flex flex-grow items-center justify-between">
        <SvgMainLogo class="h-full w-auto" :fontControlled="false" filled />
        <UIcon name="ic:round-menu" class="text-sc-black" size="20px" />
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
        <UButton class="drop-shadow-sc-shadow hover:bg-orange-700"
          >Loslegen!</UButton
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
        <UButton class="drop-shadow-sc-shadow hover:bg-orange-700"
          >Scrum Guide</UButton
        >
      </div>
      <div class="mx-10 my-28 text-right">
        <h5
          class="bg-sc-white/70 font-heading text-xl font-bold text-sc-orange"
        >
          Noch Fragen?
        </h5>
        <p class="mb-5 bg-sc-white/70 text-sm">
          Wir sind da um dir zu helfen! Schreib uns gerne eine E-Mail:
        </p>
        <UButton class="drop-shadow-sc-shadow hover:bg-orange-700"
          >Kontaktiere uns!</UButton
        >
      </div>
    </div>
    <HomeFooter />
  </div>
</template>
