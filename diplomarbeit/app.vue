<template>
  <div class="bg-sc-white flex flex-col scroll-smooth bg-[url('/assets/img/bg-houses.svg')] bg-no-repeat bg-[center_top_20rem] sm:bg-[url('/assets/img/bg-houses-desktop.svg')] sm:bg-[center_top_18rem] sm:bg-contain">
    <header
        class="invisible sm:visible flex items-center text-xs sm:text-xl w-screen flex-row h-12 sm:h-28 bg-sc-white text-center justify-center sm:justify-between sm:px-9 fixed pb-2.5 drop-shadow-header">
      <a href="/">
        <img src="assets/img/schriftlogo.svg" class="w-[300px] hidden sm:block"
             alt="Schriftlogo des Projekts ScrumpliCity, es zeigt den Schriftzug ScrumpliCity mit einer Illustration von 3 Häusern welche von einem Kreis, welcher an Scrum erinnert, umkreist sind">
      </a>
      <div class="flex items-end flex-row sm:justify-end underline">
        <a href="#projektbeschreibung">Projekt</a>
        <a class="mx-16" href="#ziele">Ziele</a>
        <a href="#team">Team</a>
      </div>
    </header>
    <main
        class="flex flex-col items-center mt-16 sm:mt-40">
      <h1 class="sm:scroll-mt-36 text-3xl font-logo sm:text-6xl" id="/">
        Willkommen bei
      </h1>
      <img src="assets/img/schriftlogo.svg" class="mx-12 my-2 sm:h-24 sm:mt-3 sm:mb-28"
           alt="Schriftlogo des Projekts ScrumpliCity, es zeigt den Schriftzug ScrumpliCity mit einer Illustration von 3 Häusern welche von einem Kreis, welcher an Scrum erinnert, umkreist sind">
      <p class="sm:scroll-mt-36 text-sc-orange mt-12 sm:mt-16 text-2xl sm:text-4xl mb-6 sm:mb-7 font-heading"
         id="projektbeschreibung">
        Unser Projekt
      </p>
      <p class="text-justify sm:mb-20 text-sm sm:text-xl leading-6 sm:leading-9 mx-8 sm:mx-[400px]">
        Im Rahmen dieser Diplomarbeit wird von uns eine Web-Applikation entwickelt, welche spielerisch die
        Projektmanagementmethode Scrum vermitteln soll. Lernende sollen in Kleingruppen Städte aus Papier bauen
        können
        und währenddessen Einblicke in die verschiedenen Phasen eines Scrum-Projekts bekommen. Dabei werden sie
        durch
        vorgefertigte Bastelvorlagen und das Anleiten der Website im Lernprozess unterstützt.
      </p>
      <p class="sm:scroll-mt-36 mt-28 sm:mt-0 text-sc-orange text-2xl sm:text-4xl mb-6 sm:mb-7 font-heading"
         id="ziele">
        Unsere Ziele
      </p>
      <ul class="list-disc list-inside text-sm sm:text-xl leading-7 sm:leading-10 mx-8">
        <li>Lehrkraftprofile inkl. Registrierung & Login</li>
        <li>Einfache Raumübersicht für die Lehrkraft</li>
        <li>Gesamter Spielablauf
          <ul class="list-disc list-inside ml-4">
            <li>Backlog mit User Storys</li>
            <li>Sprint-Plannings</li>
            <li>Bauphase mit Timer</li>
            <li>Review-Meeting inkl. Velocity</li>
          </ul>
        </li>
        <li>Bastelvorlagen zum Downloaden</li>
        <li>Gezieltes Marketing</li>
      </ul>
      <p class="mt-28 mb-6 sm:mt-32 text-sc-orange text-2xl sm:text-4xl font-heading"
         id="team">
        Das Team
      </p>
      <div class="sm:flex sm:flex-row sm:mt-4 text-base sm:text-xl text-center font-bold">
        <div class="sm:flex-col">
          <div class="relative w-40 sm:w-44 sm:mx-6 mb-1.5">
            <img src="assets/img/Team/felix.jpg" class="w-full rounded-full" alt="Ein Foto des Teammitglieds Felix">
            <div
                class="absolute rounded-full inset-0 flex flex-col items-center justify-center bg-sc-white/50 text-sc-black opacity-0 hover:opacity-100 transition-opacity duration-300">
              <p>Scrum Master</p>
              <p>& Developer</p>
              <div class="flex justify-center mt-2">
                <a href="mailto:felix.wollmann@scrumplicity.app"><img src="assets/icons/VectoriconMail.svg"
                                                                      class="w-8 mx-1"></a>
                <NuxtLink to="https://www.linkedin.com/in/felixwollmann/ " target="_blank"><img
                    src="./assets/icons/VectoriconLinkedIn.svg"
                    class="w-8 mx-1"></NuxtLink>
                <NuxtLink to="https://github.com/felixwollmann" target="_blank"><img
                    src="./assets/icons/VectoriconGitHub.svg" class="w-8 mx-1"></NuxtLink>
              </div>
            </div>
          </div>
          <p class="sm:hidden">Felix Wollmann</p>
          <p class="invisible sm:visible">Felix</p>
          <p class="invisible sm:visible">Wollmann</p>
        </div>
        <div class="sm:flex-col">
          <div class="relative w-40 sm:w-44 sm:mx-6 mb-1.5 text-base">
            <img src="assets/img/Team/lisa.jpg" class="w-full rounded-full" alt="Ein Foto des Teammitglieds Lisa-Marie">
            <div
                class="absolute rounded-full inset-0 flex flex-col items-center justify-center bg-sc-white/50 text-sc-black opacity-0 hover:opacity-100 transition-opacity duration-300">
              <p>Product Owner</p>
              <p>& Developer</p>
              <div class="flex justify-center mt-2">
                <a href="mailto:lisa-marie.hoermann@scrumplicity.app"><img src="assets/icons/VectoriconMail.svg"
                                                                           class="w-8 mx-1"></a>
                <NuxtLink to="https://www.linkedin.com/in/lisa-marie-hörmann-607525316/" target="_blank"><img
                    src="./assets/icons/VectoriconLinkedIn.svg"
                    class="w-8 mx-1"></NuxtLink>
                <NuxtLink to="https://github.com/dasechtelima" target="_blank"><img
                    src="./assets/icons/VectoriconGitHub.svg" class="w-8 mx-1"></NuxtLink>
              </div>
            </div>
          </div>
          <p class="sm:hidden">Lisa-Marie Hörmann</p>
          <p class="invisible sm:visible">Lisa-Marie</p>
          <p class="invisible sm:visible">Hörmann</p>
        </div>
        <div class="sm:flex-col place-items-center">
          <div class="relative w-40 sm:w-44 sm:mx-6 mb-1.5 text-base">
            <img src="assets/img/Team/marco.png" class="w-full rounded-full" alt="Ein Foto des Teammitglieds Marco">
            <div
                class="absolute rounded-full inset-0 flex flex-col items-center justify-center bg-sc-white/50 text-sc-black opacity-0 hover:opacity-100 transition-opacity duration-300">
              <p>Projektmitglied</p>
              <p>& Developer</p>
              <div class="flex justify-center mt-2">
                <a href="mailto:marco.janderka@scrumplicity.app"><img src="assets/icons/VectoriconMail.svg"
                                                                      class="w-8 mx-1"></a>
                <NuxtLink to="https://www.linkedin.com/in/felixwollmann/ " target="_blank"><img
                    src="./assets/icons/VectoriconLinkedIn.svg"
                    class="w-8 mx-1"></NuxtLink>
                <NuxtLink to="https://github.com/Pycxtv" target="_blank"><img
                    src="./assets/icons/VectoriconGitHub.svg" class="w-8 mx-1"></NuxtLink>
              </div>
            </div>
          </div>
          <p class="sm:hidden">Marco Janderka</p>
          <p class="invisible sm:visible">Marco</p>
          <p class="invisible sm:visible">Janderka</p>
        </div>
        <div class="sm:flex-col">
          <div class="relative w-40 sm:w-44 sm:mx-6 mb-1.5 text-base">
            <img src="assets/img/Team/sophie.jpg" class="w-full rounded-full" alt="Ein Foto des Teammitglieds Sophie">
            <div
                class="absolute rounded-full inset-0 flex flex-col items-center justify-center bg-sc-white/50 text-sc-black opacity-0 hover:opacity-100 transition-opacity duration-300">
              <p>Projektmitglied</p>
              <p>& Head of Design</p>
              <div class="flex justify-center mt-2">
                <a href="mailto:sophie.nemecek@scrumplicity.app"><img src="assets/icons/VectoriconMail.svg"
                                                                      class="w-8 mx-1"></a>
                <NuxtLink to="https://www.linkedin.com/in/sophie-nemecek/" target="_blank"><img
                    src="./assets/icons/VectoriconLinkedIn.svg"
                    class="w-8 mx-1"></NuxtLink>
                <NuxtLink to="https://github.com/soplikessoup" target="_blank"><img
                    src="./assets/icons/VectoriconGitHub.svg" class="w-8 mx-1"></NuxtLink>
              </div>
            </div>
          </div>
          <p class="sm:hidden">Sophie Nemecek</p>
          <p class="invisible sm:visible">Sophie</p>
          <p class="invisible sm:visible">Nemecek</p>
        </div>
      </div>
    </main>
    <footer class="flex flex-row text-xs sm:text-base mb-3 sm:mb-7 mt-16">
      <p class="ml-3 sm:ml-9">©2024, ScrumpliCity</p>
    </footer>
  </div>
</template>
<script setup lang="ts">
</script>