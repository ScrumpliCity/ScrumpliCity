<script setup>
definePageMeta({
  layout: "play-default",
});

defineI18nRoute({
  paths: {
    de: "/play/[roomcode]",
    en: "/play/[roomcode]",
  },
});

//@TODO: send name to backend
const teamName = ref("");

function navigateToMembers() {
  navigateTo({ path: "/play/members" });
}
</script>
<template>
  <Infobox>
    <template #title>
      <h2 class="font-heading text-2xl font-medium text-sc-black-900">
        {{ $t("infobox.scrum_roles.title") }}
      </h2>
    </template>
    <template #content>
      <i18n-t
        keypath="infobox.scrum_roles.content"
        tag="p"
        class="my-2 text-sc-black-500"
      >
        <template #roles>
          <ul class="ml-6 list-disc font-bold">
            <li>{{ $t("infobox.scrum_roles.roles.scrum_master") }}</li>
            <li>
              {{ $t("infobox.scrum_roles.roles.product_owner") }}
            </li>
            <li>
              {{ $t("infobox.scrum_roles.roles.development_team") }}
            </li>
          </ul>
        </template>
      </i18n-t>
    </template>
  </Infobox>
  <div class="flex h-full w-full flex-col items-center">
    <h1 class="font-heading text-6xl font-bold text-sc-orange">
      {{ $t("join_room.team_title") }}
    </h1>
    <div class="relative mb-12 mt-16">
      <input
        @keydown.enter="navigateToMembers"
        class="rounded-lg border-2 border-sc-black-400 py-8 text-center text-5xl font-medium drop-shadow-sc-shadow"
        :placeholder="$t('join_room.team_name')"
        v-model="teamName"
      />
      <UIcon
        name="ic:round-check"
        class="absolute right-14 top-1/2 -translate-y-1/2 transform p-12 text-sc-green"
        v-if="teamName"
      />
    </div>
    <button
      @click="navigateToMembers"
      :disabled="!teamName"
      class="w-72 cursor-pointer rounded-lg bg-sc-green py-6 text-center text-4xl font-bold text-sc-black drop-shadow-sc-shadow hover:bg-sc-green-400 disabled:cursor-not-allowed disabled:bg-sc-black-400 disabled:text-sc-white"
    >
      {{ $t("join_room.team_join") }}
    </button>
  </div>
</template>
