<script lang="ts" setup>
import type { User } from "~/types/api";

const sanctumConfig = useSanctumConfig();
const user = useSanctumUser() as Ref<User>;
const auth = useSanctumAuth();
const localeRoute = useLocaleRoute();
const toast = useToast();
const { t } = useI18n();
const client = useSanctumClient();

async function signOut() {
  try {
    await navigateTo(localeRoute("/"));
    await auth.logout();
    toast.add({
      title: t("rooms.profile.signed_out_successfully"),
      icon: "mdi:success",
    });
  } catch {
    toast.add({
      title: t("rooms.profile.sign_out_error"),
      icon: "material-symbols:error-outline",
    });
  }
}

const isSavingName = ref(false);
const isEditingName = ref(false);
const inputName = ref(user.value.name);
const inputNameElement = useTemplateRef("inputNameElement");

async function saveName() {
  if (isSavingName.value) return;
  isSavingName.value = true;
  isEditingName.value = false;
  try {
    if (user.value.name !== inputName.value)
      await client("/api/user", {
        method: "PATCH",
        body: {
          name: inputName.value,
        },
      });
    await auth.refreshIdentity();
  } finally {
    isSavingName.value = false;
  }
}

async function editName() {
  if (isSavingName.value) return;
  isEditingName.value = true;
  await nextTick();
  inputNameElement.value?.focus();
}
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
      <UPopover :ui="{ ring: '' }">
        <UAvatar
          class="cursor-pointer bg-sc-black-100 outline-none ring-sc-black-100 transition-shadow focus-within:ring-8 hover:ring-8"
          tabindex="0"
          :alt="user?.name"
          size="md"
          :src="`${sanctumConfig.baseUrl}/api/user/profile-picture`"
        />
        <template #panel>
          <div
            class="flex w-72 flex-col divide-y divide-sc-black-500 bg-sc-black-100 ring-0 drop-shadow-sc-shadow"
          >
            <div class="flex flex-col gap-5 pb-6 pl-5 pr-4 pt-4">
              <h2 class="text-xl font-bold">
                {{ $t("rooms.profile.account") }}
              </h2>
              <div class="flex items-center gap-4">
                <UAvatar
                  class="bg-sc-black-200"
                  :alt="user?.name"
                  size="lg"
                  :src="`${sanctumConfig.baseUrl}/api/user/profile-picture`"
                />
                <div class="flex flex-1 flex-col">
                  <div class="flex items-center justify-between gap-4">
                    <input
                      type="text"
                      v-if="isEditingName"
                      class="mb-1 w-0 flex-1 rounded bg-transparent text-base font-bold leading-5 ring-0 ring-sc-orange ring-offset-1 ring-offset-sc-black-100 transition-shadow focus:outline-none focus:ring-2"
                      @keydown.enter.prevent="saveName"
                      spellcheck="false"
                      @blur="saveName"
                      v-model="inputName"
                      ref="inputNameElement"
                    />
                    <p
                      v-else
                      class="mb-1 line-clamp-2 w-0 flex-1 text-ellipsis whitespace-pre-wrap break-words rounded text-base font-bold leading-5"
                    >
                      {{ inputName }}
                    </p>
                    <button
                      class="flex items-center justify-center"
                      :disabled="isSavingName || isEditingName"
                    >
                      <UIcon
                        :name="
                          isSavingName
                            ? 'heroicons:arrow-path-16-solid'
                            : isEditingName
                              ? 'material-symbols:save-rounded'
                              : 'material-symbols:edit-outline-rounded'
                        "
                        class="size-5 text-sc-black-700"
                        :class="{ 'animate-spin': isSavingName }"
                        @click="editName"
                      ></UIcon>
                    </button>
                  </div>
                  <p class="text-xs">{{ user.email }}</p>
                </div>
              </div>
            </div>
            <button
              class="flex items-center justify-between py-3.5 pl-5 pr-4 transition-colors hover:bg-sc-black-200"
              @click="signOut"
            >
              <span class="text-xl font-bold">{{
                $t("rooms.profile.sign_out")
              }}</span>
              <UIcon
                name="ic:round-log-out"
                class="size-5 text-sc-orange-500"
              ></UIcon>
            </button>
          </div>
        </template>
      </UPopover>
    </div>
  </header>
</template>
