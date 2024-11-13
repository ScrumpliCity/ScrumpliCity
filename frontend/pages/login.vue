<script setup lang="ts">
definePageMeta({
  layout: "login",
  middleware: ["sanctum:guest"],
});

const client = useSanctumClient();
const auth = useSanctumAuth();
const localeRoute = useLocaleRoute();
const { t } = useI18n();

const popupIsOpen = ref(false);

const checkOpenWindowIntervalId: Ref<number | undefined> = ref();

async function loginWithMicrosoft() {
  try {
    popupIsOpen.value = true;

    // get redirect url from backend
    const { url } = await client("/oauth/microsoft");

    // open popup
    const popup = window.open(url, "_blank", "width=600,height=600");

    // check periodically if popup is closed to enable button again
    checkOpenWindowIntervalId.value = setInterval(() => {
      if (!popup || popup.closed) {
        clearInterval(checkOpenWindowIntervalId.value);
        popupIsOpen.value = false;
      }
    }, 50) as unknown as number;
  } catch {
    showErrorMessage();
  }
}

function clearCheckOpenWindowInterval() {
  clearInterval(checkOpenWindowIntervalId.value);
}

const isLoggingIn = ref(false);

async function handleCallback(event: MessageEvent) {
  try {
    clearCheckOpenWindowInterval();
    popupIsOpen.value = false;
    isLoggingIn.value = true;
    const { code } = event.data;
    const response = await client("/oauth/microsoft/callback", {
      params: {
        code,
      },
    });
    await auth.refreshIdentity();
    await navigateTo(localeRoute("rooms"));
  } catch {
    showErrorMessage();
  }
}

function showErrorMessage() {
  isLoggingIn.value = false;
  popupIsOpen.value = false;
  clearCheckOpenWindowInterval();

  useToast().add({
    title: t("login.error"),
    icon: "material-symbols:error-outline",
  });
}

onMounted(() => {
  window.addEventListener("message", handleCallback);
});
onBeforeUnmount(() => {
  clearCheckOpenWindowInterval();
  window.removeEventListener("message", handleCallback);
});
</script>

<template>
  <div class="relative flex h-full flex-col items-center pt-32">
    <h1
      class="pb-16 text-center font-heading text-5xl font-bold text-sc-orange"
    >
      {{ $t("login.log_in_to_scrumplicity") }}
    </h1>
    <p class="pb-7 text-center font-heading text-3xl font-medium">
      {{ $t("login.log_in_with") }}
    </p>

    <UButton
      @click="loginWithMicrosoft"
      icon="logos:microsoft-icon"
      :loading="popupIsOpen"
      block
      size="xl"
      class="w-64 bg-sc-black-300 text-center text-xl font-bold text-sc-white transition hover:bg-sc-black-400 disabled:bg-sc-black-300"
      >{{ $t("login.microsoft") }}</UButton
    >

    <p
      class="absolute bottom-[1vw] left-[50vw] -translate-x-1/2 bg-sc-white text-2xl font-bold text-sc-black-500"
    >
      {{ $t("common.imprint") }}
    </p>
    <Teleport to="#teleports">
      <LoadingSpinner
        class="z-10 rounded-xl backdrop-blur-md"
        v-if="isLoggingIn"
      />
    </Teleport>
  </div>
</template>
