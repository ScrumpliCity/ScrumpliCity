<template>
  <HomeHeader />
  <div class="flex h-fit min-h-screen flex-col px-[5vw]">
    <div class="mt-36 flex flex-col items-center justify-center">
      <h1 class="font-heading text-6xl font-bold text-sc-orange">
        {{ $t("role.title") }}
      </h1>
      <p class="mt-7 text-2xl">{{ $t("role.description") }}</p>
      <div
        class="mt-14 flex flex-row gap-28 font-heading text-3xl font-bold text-sc-orange"
      >
        <NuxtLinkLocale
          to="/play"
          class="bg-sc-wite flex h-[303px] w-96 flex-col items-center rounded-lg border-2 border-dashed border-sc-orange shadow-[0px_4px_8px_0px_rgba(0,0,0,0.25)] hover:bg-sc-black-100"
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
          class="bg-sc-wite flex h-[303px] w-96 flex-col items-center rounded-lg border-2 border-dashed border-sc-orange shadow-[0px_4px_8px_0px_rgba(0,0,0,0.25)] hover:bg-sc-black-100"
        >
          <SvgTutorSm class="m-11 h-36 w-auto" :fontControlled="false" filled />
          <p>{{ $t("role.tutor") }}</p>
        </NuxtLinkLocale>
      </div>
    </div>
  </div>
</template>
