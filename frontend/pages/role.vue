<template>
  <div class="absolute h-full w-full bg-sc-white">
    <SvgRoleBackground class="w-full px-[3vw]" filled :fontControlled="false" />
  </div>
  <div class="relative flex flex-col">
    <HomeHeader />
    <div class="flex min-h-[100vh] w-screen flex-1 flex-col items-center">
      <h1
        class="mt-36 font-heading text-5xl font-bold text-sc-orange min-[1570px]:text-6xl"
      >
        {{ $t("role.title") }}
      </h1>
      <p class="mt-7 text-xl min-[1570px]:text-2xl">
        {{ $t("role.description") }}
      </p>
      <div
        class="mt-14 flex flex-row gap-28 font-heading text-2xl font-bold text-sc-orange min-[1570px]:text-3xl"
      >
        <NuxtLinkLocale
          to="/play"
          class="flex h-[303px] w-96 flex-col items-center rounded-lg border-2 border-dashed border-sc-orange bg-sc-white shadow-[0px_4px_8px_0px_rgba(0,0,0,0.25)] hover:bg-sc-black-100"
        >
          <SvgLearnerSm
            class="m-11 h-36 w-auto"
            :fontControlled="false"
            filled
          />
          <p>{{ $t("role.learner") }}</p>
        </NuxtLinkLocale>
        <NuxtLinkLocale
          to="/login"
          class="flex h-[303px] w-96 flex-col items-center rounded-lg border-2 border-dashed border-sc-orange bg-sc-white shadow-[0px_4px_8px_0px_rgba(0,0,0,0.25)] hover:bg-sc-black-100"
        >
          <SvgTutorSm class="m-11 h-36 w-auto" :fontControlled="false" filled />
          <p>{{ $t("role.tutor") }}</p>
        </NuxtLinkLocale>
      </div>
    </div>
    <HomeFooter />
  </div>
</template>
