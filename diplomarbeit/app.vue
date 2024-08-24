<template>
  <div class="bg-sc-white flex flex-col">
    <header class="text-xs flex items-end w-screen h-12 mb-14 bg-sc-white justify-between underline px-24 fixed pb-2.5">
      <a href="projektbeschreibung">Projekt</a>
      <a href="ziele">Ziele</a>
      <a href="team">Team</a>
    </header>
    <main class="flex flex-col items-center mt-28 bg-[url('/assets/img/bg-houses.svg')] bg-no-repeat" style="background-position: center 380px;">
      <h1 class="text-3xl font-logo">
        Willkommen bei
      </h1>
      <img src="assets/img/schriftlogo.svg" class="mx-12 my-2"
           alt="Schriftlogo des Projekts ScrumpliCity, es zeigt den Schriftzug ScrumpliCity mit einer Illustration von 3 Häusern welche von einem Kreis, welcher an Scrum erinnert, umkreist sind">

      <p class="text-sc-orange mt-12 text-2xl mb-6 font-heading" id="projektbeschreibung">
        Unser Projekt
      </p>
      <p class="text-justify text-sm leading-6 mx-8">
        Im Rahmen dieser Diplomarbeit wird von uns eine Web-Applikation entwickelt, welche spielerisch die
        Projektmanagementmethode Scrum vermitteln soll. Lernende sollen in Kleingruppen Städte aus Papier bauen
        können
        und währenddessen Einblicke in die verschiedenen Phasen eines Scrum-Projekts bekommen. Dabei werden sie
        durch
        vorgefertigte Bastelvorlagen und das Anleiten der Website im Lernprozess unterstützt.
      </p>
      <p class="mt-36 text-sc-orange text-2xl mb-6 font-heading" id="ziele">
        Unsere Ziele
      </p>
      <ul class="list-disc list-inside text-sm leading-7 mx-8">
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
      <p class="mt-36 text-sc-orange text-2xl font-heading" id="team">
        Das Team
      </p>
      <img src="assets/img/Team/felix.png" class="w-40 mt-4 mb-1.5" alt="Ein Foto des Teammitglieds Felix">
      <p class="text-sm">Scrum Master & Developer</p>
      <img src="assets/img/Team/lisa.png" class="w-40 mt-4 mb-1.5" alt="Ein Foto des Teammitglieds Lisa">
      <p class="text-sm">Product Owner & Developer</p>
      <img src="assets/img/Team/marco.png" class="w-40 mt-4 mb-1.5" alt="Ein Foto des Teammitglieds Marco">
      <p class="text-sm">Developer</p>
      <img src="assets/img/Team/sophie.png" class="w-40 mt-4 mb-1.5" alt="Ein Foto des Teammitglieds Sophie">
      <p class="text-sm">Head of Design</p>
    </main>
    <footer class="flex flex-row text-xs mb-3 mt-16">
      <p class="ml-2 mr-6">©2024, ScrumpliCity</p>
      <NuxtLink class="underline">Impressum</NuxtLink>
    </footer>
  </div>
</template>
<script setup lang="ts">
</script>