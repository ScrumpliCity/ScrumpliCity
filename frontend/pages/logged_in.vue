<script setup>
definePageMeta({
    middleware: ['sanctum:auth'],
});

const user = useSanctumUser();
</script>
<template>
    logged in! User: {{ user }}
</template>