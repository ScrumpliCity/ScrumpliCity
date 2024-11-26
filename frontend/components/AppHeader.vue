<script lang="ts" setup>
import type { User } from "~/types/api";

const sanctumConfig = useSanctumConfig();
const user = useSanctumUser() as Ref<User>;
</script>

<template>
  <header
    class="sticky top-0 z-50 flex h-20 w-full items-center bg-sc-white px-14 shadow-[0px_4px_8px_0px_rgba(0,0,0,0.25)]"
  >
    <NuxtLinkLocale to="/" class="mt-2">
      <SvgMainLogo :font-controlled="false" class="h-10" />
    </NuxtLinkLocale>
    <div class="flex-1"></div>
    <div class="flex items-center gap-4">
      <ChangeLangButton />
      <UButton
        class="hover:bg-sc-black-100"
        variant="ghost"
        color="black"
        :padded="true"
        :ui="{
          padding: { sm: 'p-[0.15em]' },
          rounded: 'rounded-full',
        }"
      >
        <SvgDownload :font-controlled="false" class="h-14 w-14" />
      </UButton>
      <UAvatar
        class="bg-sc-black-100"
        :alt="user.name"
        size="md"
        :src="`${sanctumConfig.baseUrl}/api/user/profile-picture`"
      />
    </div>
  </header>
</template>
