export default defineNuxtConfig({
  compatibilityDate: "2024-10-21",
  devtools: { enabled: true },
  modules: [
    "@nuxtjs/i18n",
    "nuxt-auth-sanctum",
    "nuxt-svgo",
    "@nuxt/ui",
    "@pinia/nuxt",
  ],
  i18n: {
    defaultLocale: "de",
    locales: [
      { code: "de", file: "de.json", language: "de-AT" },
      { code: "en", file: "en.json", language: "en-US" },
    ],
    lazy: true,
    langDir: "locales/",
    vueI18n: "./i18n/i18n.config.ts",
    strategy: "prefix_except_default",
    customRoutes: "config",
    pages: {
      //route for room overview
      "rooms/parent": {
        de: "/räume",
        en: "/rooms",
      },
      //route for create room modal
      "rooms/parent/create": {
        de: "/räume/erstellen",
        en: "/rooms/create",
      },
      "rooms/[id]/manage": {
        de: "/räume/[id]/verwalten",
        en: "/rooms/[id]/manage",
      },
      "rooms/[id]/roomcode": {
        de: "/räume/[id]/verwalten/raumcode",
        en: "/rooms/[id]/manage/roomcode",
      },
      "play/members": {
        de: "/play/mitglieder",
        en: "/play/members",
      },
      "play/ready": {
        de: "/play/bereit",
        en: "/play/ready",
      },
      // define more pages here
    },
  },
  tailwindcss: {
    cssPath: "~/assets/css/style.css",
  },
  sanctum: {
    baseUrl:
      process.env.SCRUMPLICITY_LARAVEL_API_URL ?? "http://localhost:8000", // Laravel API
    redirect: {
      onLogin: false, // don't redirect after login or logout
      onLogout: false,
      onAuthOnly: "login", // used by our own custom middleware "auth" for locale-aware redirection to login page
      onGuestOnly: "rooms-parent", // used by our own "guest" middlware for locale-aware redirection to rooms
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
