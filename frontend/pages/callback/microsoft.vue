<script setup lang="ts">
// disable localization on this route
defineI18nRoute(false);

onMounted(async () => {
  const route = useRoute();
  const localeRoute = useLocaleRoute();

  const {
    query: { code },
  } = route;

  // if not opened in popup redirect to / with 404 code
  if (!window.opener) {
    await navigateTo(localeRoute("/"), {
      redirectCode: 404,
      replace: true,
    });
  } else {
    // send oauth ?code=... back to /login
    window.opener.postMessage({ code }, window.location.origin);

    window.close();
  }
});
</script>
<template>
  <Teleport to="#teleports">
    <LoadingSpinner />
  </Teleport>
</template>
