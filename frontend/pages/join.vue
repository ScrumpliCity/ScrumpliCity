<script setup>
const switchLocalePath = useSwitchLocalePath()
</script>
<template>
    <div>
        <h1>{{ $t('join') }}</h1>
        <p>{{ $t('welcome_message') }}</p>
        <NuxtLink :to="switchLocalePath('de')">Deutsch</NuxtLink>
        <NuxtLink :to="switchLocalePath('en')">English</NuxtLink>
    </div>
</template>
