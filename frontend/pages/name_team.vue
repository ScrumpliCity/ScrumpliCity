<script setup xmlns="http://www.w3.org/1999/html">
const {locale, setLocale} = useI18n();
const localeRoute = useLocaleRoute();

function switchLocale() {
  setLocale(locale.value === "de" ? "en" : "de");
}

//@TODO: send name to backend
const teamName = ref('');

</script>
<template>
  <div
      class="flex flex-col w-full h-screen items-center bg-[url('/assets/svg/join-room/join.svg')] bg-contain bg-no-repeat bg-bottom">
    <div class="flex w-full place-content-end pt-11 pr-11 mb-[4%]">
      <UButton
          @click="switchLocale()"
          :padded="false"
          variant="ghost"
          class="hover:bg-transparent"
      >
        <template #leading>
          <LazySvgI18nDe
              v-if="locale === 'de'"
              :font-controlled="false"
              class="size-14"
              filled
          />
          <LazySvgI18nEn
              v-else
              :font-controlled="false"
              class="size-14"
              filled
          />
        </template>
      </UButton>
    </div>
    <h1 class="font-heading text-6xl font-bold text-sc-orange">
      {{ $t("join-room.team-title") }}
    </h1>
    <div class="relative mb-12 mt-16">
      <input
          class="rounded-lg border-2 border-sc-black-400 py-8 text-center text-5xl font-medium drop-shadow-sc-48025"
          :placeholder="$t('join-room.team-name')"
          v-model="teamName"
      />
      <UIcon
          name="ic:round-check"
          class="absolute right-14 top-1/2 -translate-y-1/2 transform p-12 text-sc-green"
          v-if="(teamName !== '')"
      />
    </div>
    <NuxtLink
        :to="localeRoute('add_team_members', locale)">
      <button
          :disabled="(teamName === '')"
          class="w-72 rounded-lg py-6 text-center text-4xl font-bold drop-shadow-sc-48025"
          :class="(teamName !== '') ? 'bg-sc-green text-sc-black hover:bg-sc-green-400' : 'text-sc-white bg-sc-black-400'"
      >
        {{ $t("join-room.team-join") }}
      </button>
    </NuxtLink>
  </div>
</template>
