export default defineNuxtConfig({
  compatibilityDate: "2024-10-21",
  devtools: { enabled: true },
  modules: ["@nuxtjs/i18n", "nuxt-auth-sanctum", "nuxt-svgo", "@nuxt/ui"],
  i18n: {
    defaultLocale: "de",
    locales: [
      { code: "de", file: "de.json", language: "de-AT" },
      { code: "en", file: "en.json", language: "en-US" },
    ],
    lazy: true,
    langDir: "locales/",
    vueI18n: "./i18n.config.ts",
    strategy: "prefix_except_default",
    customRoutes: "config",
    pages: {
      "rooms/index": {
        de: "/räume",
        en: "/rooms",
      },
      "rooms/create": {
        de: "/räume/erstellen",
        en: "/rooms/create",
      },
      "rooms/id/manage": {
        de: "/räume/[id]/verwalten",
        en: "/rooms/[id]/manage",
      },
      "rooms/id/roomcode": {
        de: "/räume/[id]/verwalten/raumcode",
        en: "/rooms/[id]/manage/roomcode",
      },
      "play/members": {
        de: "/play/mitglieder",
        en: "/play/members",
      },
      // Hier weitere Seiten definieren
    },
  },
  tailwindcss: {
    cssPath: "~/assets/css/style.css",
  },
  sanctum: {
    baseUrl:
      process.env.SCRUMPLICITY_LARAVEL_API_URL ?? "http://localhost:8000", // Laravel API
    redirect: {
      onLogin: false,
      onLogout: false,
    },
  },
  svgo: {
    componentPrefix: "Svg", // prefix (eg. assets/svg/Mainlogo.svg -> SvgMainlogo)
    autoImportPath: "~/assets/svg",
  },
  colorMode: {
    preference: "light", // without this, Nuxt UI uses it's dark mode
  },
});
