// adapted from https://github.com/manchenkoff/nuxt-auth-sanctum/blob/40908897b174fde1129e805ab6ab11842673a751/src/runtime/middleware/sanctum.guest.ts

import { defineNuxtRouteMiddleware, navigateTo, createError } from "#app";

export default defineNuxtRouteMiddleware(async (to) => {
  const options = useSanctumConfig();
  const { isAuthenticated, init } = useSanctumAuth();

  try {
    await init(); // we are not fetching login status on initial page load for pre-rendering
  } catch {
    // for whatever reason this stupid library does not do error handling on http errors
  }

  if (!isAuthenticated.value) {
    return;
  }

  const endpoint = options.redirect.onGuestOnly;

  if (endpoint === undefined) {
    throw new Error("`sanctum.redirect.onGuestOnly` is not defined");
  }

  if (endpoint === false) {
    throw createError({ statusCode: 403 });
  }

  const localeRoute = useLocaleRoute();

  const redirect = localeRoute(endpoint);

  // redirect not implemented in our middlware
  //
  // const redirect: RouteLocationAsPathGeneric = { path: endpoint };
  // if (options.redirect.keepRequestedRoute) {
  //   redirect.query = { redirect: trimTrailingSlash(to.fullPath) }
  // }

  return navigateTo(redirect, { replace: true });
});
