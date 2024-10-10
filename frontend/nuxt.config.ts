export default defineNuxtConfig({
  compatibilityDate: "2024-10-10",
  devtools: { enabled: true },
  modules: ["@nuxtjs/tailwindcss", "@nuxtjs/i18n"],
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
      // Hier weitere Seiten definieren
    },
  },
  tailwindcss: {
    cssPath: "~/assets/css/style.css",
  },
});
