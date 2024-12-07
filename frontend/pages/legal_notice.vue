<script setup>
const { t } = useI18n();
</script>
<template>
  <div class="w-1/2 self-center">
    <h1 class="font-heading">{{ $t("legal_notice.title") }}</h1>
    <h2>{{ $t("legal_notice.media_proprietor") }}:</h2>
    <p>Felix Wollmann</p>
    <h2>{{ $t("legal_notice.address") }}:</h2>
    <address>
      HTL 3 Rennweg<br />
      Rennweg 89b<br />
      1030 Wien
    </address>
    <h2>{{ $t("legal_notice.contact") }}:</h2>
    <p>
      <a href="mailto:felix.wollmann@scrumplicity.app"
        >felix.wollmann@scrumplicity.app</a
      >
    </p>
    <h2>{{ $t("legal_notice.editorial_policy.title") }}:</h2>
    <p>{{ $t("legal_notice.editorial_policy.content") }}</p>
    <h2>{{ $t("legal_notice.disclaimer.title") }}:</h2>
    <p>{{ $t("legal_notice.disclaimer.content") }}</p>
  </div>
</template>
