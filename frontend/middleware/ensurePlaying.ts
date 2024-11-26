import { useGameStore } from "~/stores/game";

export default defineNuxtRouteMiddleware(async (to) => {
  const team = useGameStore();

  if (team.isInTeam) return;

  await team.refresh();
  if (team.isInTeam) return;

  const localeRoute = useLocaleRoute();
  return navigateTo(localeRoute("play"), { replace: true, redirectCode: 404 });
});
