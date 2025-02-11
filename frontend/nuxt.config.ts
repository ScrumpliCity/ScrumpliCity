export default defineNuxtConfig({
  compatibilityDate: "2024-10-21",
  devtools: { enabled: true },
  modules: [
    "@nuxtjs/i18n",
    "nuxt-auth-sanctum",
    "nuxt-svgo",
    "@nuxt/ui",
    "@pinia/nuxt",
    "nuxt-laravel-echo",
    "@nuxtjs/seo",
  ],
  routeRules: {
    "/": {
      prerender: true,
    },
    "/role": {
      prerender: true,
    },
    "/legal_notice": {
      prerender: true,
    },
  },
  i18n: {
    defaultLocale: "en",
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
      "rooms/[id]/index": {
        de: "/räume/[id]",
        en: "/rooms/[id]",
      },
      "rooms/[id]/roomcode": {
        de: "/räume/[id]/raumcode",
        en: "/rooms/[id]/roomcode",
      },
      "play/members": {
        de: "/play/mitglieder",
        en: "/play/members",
      },
      "play/ready": {
        de: "/play/bereit",
        en: "/play/ready",
      },
      legal_notice: {
        de: "/impressum",
        en: "/legal-notice",
      },
      role: {
        de: "/rolle",
        en: "/role",
      },
      "play/[sprint]/build_phase": {
        de: "/play/[sprint]/bauphase",
        en: "/play/[sprint]/build_phase",
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
    preference: "light", // without this, Nuxt UI uses its dark mode
  },
  echo: {
    host: process.env.REVERB_HOST ?? "localhost",
    port: Number(process.env.REVERB_PORT ?? 8888),
    scheme:
      (process.env.REVERB_SCHEME as "http" | "https" | undefined) ?? "http",
    key: "_", // overriden by runtimeConfig
    authentication: {
      mode: "cookie",
      baseUrl:
        process.env.SCRUMPLICITY_LARAVEL_API_URL ?? "http://localhost:8000",
      authEndpoint: "/broadcasting/auth",
      csrfEndpoint: "/sanctum/csrf-cookie",
      csrfCookie: "XSRF-TOKEN",
      csrfHeader: "X-XSRF-TOKEN",
    },
    logLevel: 3,
    properties: undefined,
  },
  vite: {
    // see https://manchenkoff.gitbook.io/nuxt-laravel-echo/getting-started/installation
    optimizeDeps: {
      include: ["pusher-js"],
    },
  },
  site: {
    // url set by env variables
    name: "ScrumpliCity",
    description: "Build your Scrum knowledge with ScrumpliCity!",
  },
  seo: {
    canonicalQueryWhitelist: [], // no query parameters should be included in the canonical url
  },
  app: {
    head: {
      templateParams: {
        separator: "|",
      },
    },
  },
  runtimeConfig: {
    public: {
      echo: {
        // echo key set by NUXT_PUBLIC_ECHO_KEY env variable
      },
      contactMail: "lisa-marie.hoermann@scrumplicity.app", // used in error page & homepage
    },
  },
});
