import { useGameStore } from "~/stores/game";

export default defineNuxtRouteMiddleware(async (to, from) => {
  const team = useGameStore();
  const nuxtApp = useNuxtApp();
  // run this middleware: yes on the server, on the clien only if not server rendered and not hydrating
  if (
    import.meta.client &&
    (nuxtApp.payload.serverRendered || !nuxtApp.isHydrating)
  )
    return console.log("skipping middlware");

  const localeRoute = useLocaleRoute();

  try {
    await team.refresh(true);
  } catch (error) {
    return navigateTo(localeRoute("play"), {
      replace: true,
      redirectCode: 403,
    });
  }

  if (!team.isInTeam)
    return navigateTo(localeRoute("play"), {
      replace: true,
      redirectCode: 403,
    });

  const correctRoute = team.correctRoute;
  if (!correctRoute) return;
  if (
    correctRoute.name !== to.name ||
    correctRoute.params.sprint !== to.params.sprint
  )
    return navigateTo(correctRoute);
});
