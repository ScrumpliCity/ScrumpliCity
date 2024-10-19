export default defineNuxtConfig({
  compatibilityDate: "2024-10-10",
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
      join: {
        de: "/beitreten",
        en: "/join",
      },
      rooms: {
        de: "/räume",
        en: "/rooms",
      },
      // Hier weitere Seiten definieren
    },
  },
  tailwindcss: {
    cssPath: "~/assets/css/style.css",
  },
  sanctum: {
    baseUrl: "http://localhost:8000", // Laravel API
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
