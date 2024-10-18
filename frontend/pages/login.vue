<script setup>
// definePageMeta({
//     middleware: ['sanctum:guest'],
// });
// ^ using this middleware, this page could only be seen by unauthenticated (non logged in) users

const { login, user, logout, isAuthenticated } = useSanctumAuth();

// temporary example credentials
const userCredentials = {
  email: "test@example.com",
  password: "password",
};

async function doLogin() {
  await login(userCredentials);
}

async function doLogout() {
  await logout();
}
</script>
<template>
  <main>
    <h1 class="text-xl">Temporary Login Page</h1>
    <p>
      Click the button to log in as the test user (email: test@example.com, pw:
      password)
    </p>
    <div class="flex gap-4">
      <button
        @click="doLogin"
        class="rounded bg-sc-orange px-2 py-1 text-white disabled:cursor-not-allowed disabled:bg-slate-300"
        :disabled="isAuthenticated"
      >
        Log me in! :)
      </button>
      <button
        @click="doLogout"
        class="rounded bg-sc-orange px-2 py-1 text-white disabled:cursor-not-allowed disabled:bg-slate-300"
        :disabled="!isAuthenticated"
      >
        Log me out! :(
      </button>
    </div>
    <p>Current user info (useSanctumUser()): {{ user ?? `(empty)` }}</p>
    <small>This page isn't localised as it's only temporary.</small>
  </main>
</template>
