<script setup>
const { t } = useI18n();

useSeoMeta({
  title: t("create_room.page_title"),
});

const localeRoute = useLocaleRoute();
</script>

<template>
  <RoomManager type="create" :route-to-parent="localeRoute('rooms-parent')" />
</template>
