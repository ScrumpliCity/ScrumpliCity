<template>
  <div class="bg-sc-white flex flex-col scroll-smooth">
    <header
        class="flex items-center text-xs sm:text-xl w-screen flex-row h-12 sm:h-28 bg-sc-white text-center justify-center sm:justify-between sm:px-9 fixed pb-2.5">
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
        class="flex flex-col items-center mt-16 sm:mt-40 bg-[url('/assets/img/bg-houses.svg')] bg-no-repeat bg-[center_top_24rem] sm:bg-[url('/assets/img/bg-houses-big.svg')] sm:bg-[center_top_10rem]">
      <h1 class="scroll-mt-12 sm:scroll-mt-28 text-3xl font-logo sm:text-6xl" id="/">
        Willkommen bei
      </h1>
      <img src="assets/img/schriftlogo.svg" class="mx-12 my-2 sm:h-32"
           alt="Schriftlogo des Projekts ScrumpliCity, es zeigt den Schriftzug ScrumpliCity mit einer Illustration von 3 Häusern welche von einem Kreis, welcher an Scrum erinnert, umkreist sind">

      <p class="scroll-mt-12 sm:scroll-mt-28 text-sc-orange mt-12 sm:mt-44 text-2xl sm:text-4xl mb-6 sm:mb-7 font-heading"
         id="projektbeschreibung">
        Unser Projekt
      </p>
      <p class="text-justify text-sm sm:text-xl leading-6 sm:leading-9 mx-8 sm:mx-[497px]">
        Im Rahmen dieser Diplomarbeit wird von uns eine Web-Applikation entwickelt, welche spielerisch die
        Projektmanagementmethode Scrum vermitteln soll. Lernende sollen in Kleingruppen Städte aus Papier bauen
        können
        und währenddessen Einblicke in die verschiedenen Phasen eines Scrum-Projekts bekommen. Dabei werden sie
        durch
        vorgefertigte Bastelvorlagen und das Anleiten der Website im Lernprozess unterstützt.
      </p>
      <p class="scroll-mt-12 sm:scroll-mt-28 mt-28 sm:mt-32 text-sc-orange text-2xl sm:text-4xl mb-6 sm:mb-7 font-heading"
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
      <p class="scroll-mt-12 sm:scroll-mt-0 mt-28 sm:mt-32 text-sc-orange text-2xl sm:text-4xl font-heading" id="team">
        Das Team
      </p>
      <div class="sm:flex sm:flex-row sm:mt-4 text-sm sm:text-xl text-center">
        <div class="sm:flex-col">
          <img src="assets/img/Team/felix.png" class="w-40 sm:w-44 sm:mx-6 mt-4 mb-1.5"
               alt="Ein Foto des Teammitglieds Felix">
          <p class="sm:hidden">Scrum Master & Developer</p>
          <p class="invisible sm:visible">Scrum Master</p>
          <p class="invisible sm:visible">& Developer</p>
        </div>
        <div class="sm:flex-col">
          <img src="assets/img/Team/lisa.png" class="w-40 sm:w-44 sm:mx-6 mt-4 mb-1.5"
               alt="Ein Foto des Teammitglieds Lisa">
          <p class="sm:hidden">Product Owner & Developer</p>
          <p class="invisible sm:visible">Product Owner</p>
          <p class="invisible sm:visible">& Developer</p>
        </div>
        <div class="sm:flex-col place-items-center">
          <img src="assets/img/Team/marco.png" class="w-40 sm:w-44 sm:mx-6 mt-4 mb-1.5"
               alt="Ein Foto des Teammitglieds Marco">
          <p>Developer</p>
        </div>
        <div class="sm:flex-col">
          <img src="assets/img/Team/sophie.png" class="w-40 sm:w-44 sm:mx-6 mt-4 mb-1.5"
               alt="Ein Foto des Teammitglieds Sophie">
          <p>Designer</p>
        </div>
      </div>
    </main>
    <footer class="flex flex-row text-xs sm:text-base mb-3 sm:mb-7 mt-16">
      <p class="ml-3 sm:ml-9 mr-4">©2024, ScrumpliCity</p>
      <NuxtLink class="underline">Impressum</NuxtLink>
    </footer>
  </div>
</template>
<script setup lang="ts">
</script>