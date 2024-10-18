<script setup>
definePageMeta({
  middleware: ["sanctum:auth"],
});

const user = useSanctumUser();

// fetch sth
const client = useSanctumClient();

const { data } = await useAsyncData("rooms", () => client("/api/rooms"));
</script>
<template>
  <p>logged in! User: {{ user }}</p>
  <ul class="list-disc pl-8">
    <li v-for="room in data">{{ room.name }}</li>
  </ul>
</template>
