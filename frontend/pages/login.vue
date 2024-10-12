<script setup>
definePageMeta({
    middleware: ['sanctum:guest'],
});

const { login } = useSanctumAuth();

const router = useRouter();

const userCredentials = {
    email: 'test@example.com',
    password: 'password',
};

async function doLogin() {
    await login(userCredentials);
    router.push('/logged_in');

}
</script>
<template>
<button @click="doLogin">log me in</button>
</template>
