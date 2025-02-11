<script setup>
const localeRoute = useLocaleRoute();
</script>

<template>
  <RoomManager type="create" :route-to-parent="localeRoute('rooms-parent')" />
</template>
