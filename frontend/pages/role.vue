<template>
  <div
    class="absolute top-4 h-full w-full bg-sc-white min-[1190px]:-top-[2vw] min-[1470px]:top-0 min-[1760px]:-top-[3vw]"
  >
    <SvgRoleBackground class="w-full px-[3vw]" filled :fontControlled="false" />
  </div>
  <div class="relative flex max-h-fit flex-col">
    <HomeHeader />
    <div
      class="mb-[5vw] flex w-full flex-col items-center min-[1100px]:mb-[8vw] min-[1760px]:mb-[10vw]"
    >
      <h1
        class="mt-28 font-heading text-4xl font-bold text-sc-orange xl:mt-32 xl:text-5xl min-[1470px]:mt-36 min-[1470px]:text-6xl"
      >
        {{ $t("role.title") }}
      </h1>
      <p
        class="min-[1470px]:text-min-[1470px] mt-4 text-lg xl:text-xl min-[1470px]:mt-7"
      >
        {{ $t("role.description") }}
      </p>
      <div
        class="min-[1380px]:text-min-[1470px] mt-8 flex flex-row gap-28 font-heading text-lg font-bold text-sc-orange xl:text-xl min-[1470px]:mt-14 min-[1470px]:text-3xl"
      >
        <NuxtLinkLocale
          to="/play"
          class="flex h-52 w-60 flex-col items-center justify-center rounded-lg border-2 border-dashed border-sc-orange bg-sc-white drop-shadow-sc-shadow transition-colors hover:bg-sc-black-100 min-[1380px]:h-60 min-[1380px]:w-72 min-[1470px]:h-[303px] min-[1470px]:w-96"
        >
          <SvgLearnerSm
            class="mb-6 h-24 w-auto min-[1380px]:h-28 min-[1470px]:mb-11 min-[1470px]:h-36"
            :fontControlled="false"
            filled
          />
          <p>{{ $t("role.learner") }}</p>
        </NuxtLinkLocale>
        <NuxtLinkLocale
          to="/login"
          class="flex h-52 w-60 flex-col items-center justify-center rounded-lg border-2 border-dashed border-sc-orange bg-sc-white drop-shadow-sc-shadow transition-colors hover:bg-sc-black-100 min-[1380px]:h-60 min-[1380px]:w-72 min-[1470px]:h-[303px] min-[1470px]:w-96"
        >
          <SvgTutorSm
            class="mb-6 h-24 w-auto min-[1380px]:h-28 min-[1470px]:mb-11 min-[1470px]:h-36"
            :fontControlled="false"
            filled
          />
          <p>{{ $t("role.tutor") }}</p>
        </NuxtLinkLocale>
      </div>
    </div>
    <HomeFooter />
  </div>
</template>
