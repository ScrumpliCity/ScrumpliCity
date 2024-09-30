<script setup>
const { locale, setLocale } = useI18n()
</script>

<template>
    <div>
        <div>
            <button @click="setLocale('de')">de</button>
            <br>
            <button @click="setLocale('en')">en</button>
            <p>{{ $t('welcome') }}</p>
        </div>
    </div>
</template>
