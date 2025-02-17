<template>
  <div
      class="bg-sc-white flex flex-col scroll-smooth bg-no-repeat bg-gradient-to-b from-sc-orange via-sc-yellow to-sc-green bg-left bg-[length:10px_100%] min-h-screen lg:bg-[url('/assets/img/bg-houses-desktop.svg')] lg:bg-[center_top_18rem] lg:bg-contain">
    <header
        class="invisible lg:visible flex items-center text-xs lg:text-xl w-screen flex-row h-12 lg:h-28 bg-sc-white text-center justify-center lg:justify-between lg:px-9 fixed pb-2.5 drop-shadow-header">
      <a href="/">
        <img src="assets/img/schriftlogo.svg" class="w-[300px] hidden lg:block"
             alt="Schriftlogo des Projekts ScrumpliCity, es zeigt den Schriftzug ScrumpliCity mit einer Illustration von 3 Häusern welche von einem Kreis, welcher an Scrum erinnert, umkreist sind">
      </a>
      <div class="flex items-end flex-row lg:justify-end underline">
        <a href="#projektbeschreibung">Projekt</a>
        <a class="ml-16" href="#features">Features</a>
        <a class="mx-16" href="#Lernziele">Ziele</a>
        <a href="#team">Team</a>
      </div>
    </header>
    <main
        class="flex flex-col items-center mt-16 lg:mt-40">
      <h1 class="lg:scroll-mt-36 text-3xl font-logo lg:text-6xl">
        Willkommen bei
      </h1>
      <img src="assets/img/schriftlogo.svg" class="mx-12 my-2 lg:h-24 lg:mt-3 lg:mb-28 max-w-80 lg:max-w-none"
           alt="Schriftlogo des Projekts ScrumpliCity, es zeigt den Schriftzug ScrumpliCity mit einer Illustration von 3 Häusern welche von einem Kreis, welcher an Scrum erinnert, umkreist sind">
      <p class="lg:scroll-mt-36 text-sc-orange mt-12 lg:mt-16 text-2xl lg:text-4xl mb-6 lg:mb-7 font-heading"
         id="projektbeschreibung">
        Unser Projekt
      </p>
      <p class="text-justify text-sm lg:text-xl leading-6 lg:leading-9 mx-8 lg:mx-64 xl:mx-[400px] max-w-[80ch] hyphens-manual">
        ScrumpliCity entsteht im Rahmen einer Diplomarbeit an der HTL Rennweg. Wir entwickeln eine
        Webanwendung, welche spielerisch die
        Projektmanagement&shy;methode Scrum vermitteln soll. Lernende bauen in Kleingruppen Städte aus Papier und
        erlangen
        währenddessen Einblicke in den Ablauf eines Scrum-Projekts. Unsere Web-Applikation leitet parallel dazu die
        verschiedenen Phasen von Scrum. Unterstützt werden die Lernenden auch durch vorgefertigte Bastelvorlagen.
      </p>
      <p class="lg:scroll-mt-36 mt-28 lg:mt-20 text-sc-orange text-2xl lg:text-4xl mb-6 lg:mb-7 font-heading"
         id="features">
        Features unserer Website
      </p>
      <ul class="list-disc list-inside text-sm lg:text-xl leading-7 lg:leading-10 mx-6">
        <li>Lehrkraftprofile inkl. Registrierung & Login</li>
        <li>Einfache Raumübersicht für die Lehrkraft</li>
        <li>Erstes Scrum-Projekt spielerisch vermitteln und begleiten
          <ul class="list-inside ml-8 list-[circle]">
            <li>Online zu verfassende Sprint-Backlogs</li>
            <li>Sprint-Plannings</li>
            <li>Bauphase mit Timer
              <ul class="list-inside ml-8 list-[square]">
                <li>Physische Stadt aus Papiervorlagen wird von Schülern gebaut</li>
              </ul>
            </li>
            <li>Review-Meetings inkl. Velocity-Berechnung</li>
          </ul>
        </li>
        <li>Bastelvorlagen zum Downloaden</li>
      </ul>
      <p class="lg:scroll-mt-36 mt-28 lg:mt-20 text-sc-orange text-2xl lg:text-4xl mb-6 lg:mb-7 font-heading"
         id="Lernziele">
        Lernziele für Schüler
      </p>
      <ul class="list-disc list-inside text-sm lg:text-xl leading-7 lg:leading-10 mx-8">
        <li>Projekte mit Scrum planen lernen</li>
        <li>Phasen eines Scrum-Projekts kennenlernen</li>
        <li>Scrum-Rollen kennenlernen</li>
        <li>Sprint-Meetings kennenlernen</li>
        <li>Sprint-Backlog verfassen und schätzen lernen</li>
        <li>Teamwork festigen</li>
      </ul>
      <p class="mt-28 mb-6 lg:mt-32 text-sc-orange text-2xl lg:text-4xl font-heading"
         id="team">
        Das Team
      </p>
      <div class="lg:flex lg:flex-row lg:mt-4 text-base lg:text-xl text-center font-bold">
        <div class="flex-col">
          <div class="relative w-40 lg:w-44 lg:mx-6 mb-1.5 text-base">
            <NuxtImg src="/img/Team/felix.jpg" class="w-full rounded-full" sizes="160px lg:176px" alt="Ein Foto des Teammitglieds Felix"/>
            <div
                class="absolute rounded-full inset-0 flex flex-col items-center justify-center bg-sc-white/50 text-sc-black opacity-0 hover:opacity-100 transition-opacity duration-300">
              <p>Scrum Master</p>
              <p>& Developer</p>
              <div class="flex justify-center mt-2">
                <a href="mailto:felix.wollmann@scrumplicity.app"><img src="assets/icons/VectoriconMail.svg"
                                                                      class="w-8 mx-1" alt="E-Mail"></a>
                <NuxtLink to="https://www.linkedin.com/in/felixwollmann/ " target="_blank"><img
                    src="./assets/icons/VectoriconLinkedIn.svg"
                    class="w-8 mx-1" alt="LinkedIn-Logo"></NuxtLink>
                <NuxtLink to="https://github.com/felixwollmann" target="_blank"><img
                    src="./assets/icons/VectoriconGitHub.svg" class="w-8 mx-1" alt="GitHub-Logo"></NuxtLink>
              </div>
            </div>
          </div>
          <p class="lg:hidden">Felix Wollmann</p>
          <p class="invisible lg:visible">Felix</p>
          <p class="invisible lg:visible">Wollmann</p>
        </div>
        <div class="flex-col">
          <div class="relative w-40 lg:w-44 lg:mx-6 mb-1.5 text-base">
            <NuxtImg src="/img/Team/lisa.jpg" class="w-full rounded-full" sizes="160px lg:176px" alt="Ein Foto des Teammitglieds Lisa-Marie"/>
            <div
                class="absolute rounded-full inset-0 flex flex-col items-center justify-center bg-sc-white/50 text-sc-black opacity-0 hover:opacity-100 transition-opacity duration-300">
              <p>Product Owner</p>
              <p>& Developer</p>
              <div class="flex justify-center mt-2">
                <a href="mailto:lisa-marie.hoermann@scrumplicity.app"><img src="assets/icons/VectoriconMail.svg"
                                                                           class="w-8 mx-1" alt="E-Mail"></a>
                <NuxtLink to="https://www.linkedin.com/in/lisa-marie-hörmann/" target="_blank"><img
                    src="./assets/icons/VectoriconLinkedIn.svg"
                    class="w-8 mx-1" alt="LinkedIn-Logo"></NuxtLink>
                <NuxtLink to="https://github.com/dasechtelima" target="_blank"><img
                    src="./assets/icons/VectoriconGitHub.svg" class="w-8 mx-1" alt="GitHub-Logo"></NuxtLink>
              </div>
            </div>
          </div>
          <p class="lg:hidden">Lisa-Marie Hörmann</p>
          <p class="invisible lg:visible">Lisa-Marie</p>
          <p class="invisible lg:visible">Hörmann</p>
        </div>
        <div class="lg:flex-col place-items-center">
          <div class="relative w-40 lg:w-44 lg:mx-6 mb-1.5 text-base">
            <NuxtImg src="/img/Team/marco.jpg" class="w-full rounded-full" sizes="160px lg:176px" alt="Ein Foto des Teammitglieds Marco"/>
            <div
                class="absolute rounded-full inset-0 flex flex-col items-center justify-center bg-sc-white/50 text-sc-black opacity-0 hover:opacity-100 transition-opacity duration-300">
              <p>Projektmitglied</p>
              <p>& Developer</p>
              <div class="flex justify-center mt-2">
                <a href="mailto:marco.janderka@scrumplicity.app"><img src="assets/icons/VectoriconMail.svg"
                                                                      class="w-8 mx-1" alt="E-Mail"></a>
                <NuxtLink to="https://www.linkedin.com/in/marco-janderka/" target="_blank"><img
                    src="./assets/icons/VectoriconLinkedIn.svg"
                    class="w-8 mx-1" alt="LinkedIn-Logo"></NuxtLink>
                <NuxtLink to="https://github.com/Pycxtv" target="_blank"><img
                    src="./assets/icons/VectoriconGitHub.svg" class="w-8 mx-1" alt="GitHub-Logo"></NuxtLink>
              </div>
            </div>
          </div>
          <p class="lg:hidden">Marco Janderka</p>
          <p class="invisible lg:visible">Marco</p>
          <p class="invisible lg:visible">Janderka</p>
        </div>
        <div class="flex-col">
          <div class="relative w-40 lg:w-44 lg:mx-6 mb-1.5 text-base">
            <NuxtImg src="/img/Team/sophie.jpg" class="w-full rounded-full" sizes="160px lg:176px" alt="Ein Foto des Teammitglieds Sophie"/>
            <div
                class="absolute rounded-full inset-0 flex flex-col items-center justify-center bg-sc-white/50 text-sc-black opacity-0 hover:opacity-100 transition-opacity duration-300">
              <p>Projektmitglied</p>
              <p>& Head of Design</p>
              <div class="flex justify-center mt-2">
                <a href="mailto:sophie.nemecek@scrumplicity.app"><img src="assets/icons/VectoriconMail.svg"
                                                                      class="w-8 mx-1" alt="E-Mail"></a>
                <NuxtLink to="https://www.linkedin.com/in/sophie-nemecek/" target="_blank"><img
                    src="./assets/icons/VectoriconLinkedIn.svg"
                    class="w-8 mx-1" alt="LinkedIn-Logo"></NuxtLink>
                <NuxtLink to="https://github.com/soplikessoup" target="_blank"><img
                    src="./assets/icons/VectoriconGitHub.svg" class="w-8 mx-1" alt="GitHub-Logo"></NuxtLink>
              </div>
            </div>
          </div>
          <p class="lg:hidden">Sophie Nemecek</p>
          <p class="invisible lg:visible">Sophie</p>
          <p class="invisible lg:visible">Nemecek</p>
        </div>
      </div>
    </main>
    <footer class="flex flex-row text-xs lg:text-base mb-3 lg:mb-7 mt-16 justify-around">
      <p class="ml-3 lg:ml-9">©2025, ScrumpliCity</p>
      <NuxtLink to="https://dev.scrumplicity.app/impressum">Impressum</NuxtLink>
    </footer>
  </div>
</template>
<script setup lang="ts">
useSeoMeta({
  title: 'ScrumpliCity - Build Your Scrum Knowledge',
  ogTitle: 'ScrumpliCity - Build Your Scrum Knowledge',
  description: 'Lerne spielerisch die Projektmanagementmethode Scrum mit ScrumpliCity. ScrumpliCity entsteht im Rahmen einer Diplomarbeit an der HTL Rennweg.',
  ogDescription: 'Lerne spielerisch die Projektmanagementmethode Scrum mit ScrumpliCity. ScrumpliCity entsteht im Rahmen einer Diplomarbeit an der HTL Rennweg.',
  ogUrl: 'https://diplomarbeit.scrumplicity.app',
  ogType: 'website',
  ogImage: '/og-image.png',
  ogImageAlt: 'Willkommen bei ScrumpliCity. Unser Logo besteht aus dem Schriftzug ScrumpliCity und einer Illustration von 3 Häusern. Diese Häuser sind auch im Hintergrund dieses Bildes zu finden und haben die Farben Orange, Gelb und Grün.',
  ogImageWidth: '1200',
  ogImageHeight: '600',
  twitterCard: 'summary_large_image',
  viewport: 'width=device-width, initial-scale=1.0',
  colorScheme: 'only light',
})
</script>
