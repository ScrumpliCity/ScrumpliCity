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
    "@vueuse/nuxt",
    "@nuxtjs/seo",
  ],
  routeRules: {
    // https://github.com/nuxt-modules/i18n/issues/2342 // there doesn't seem to be a cleaner way to define route rules than like this ... f*ck localized slugs
    "/": {
      swr: true,
    },
    "/de": {
      swr: true,
    },
    "/legal-notice": {
      swr: true,
    },
    "/de/impressum": {
      swr: true,
    },
    "/role": {
      swr: true,
    },
    "/de/rolle": {
      swr: true,
    },
    "/**": {
      seoMeta: {
        ogImage: "/og-image-en.png",
        ogImageAlt: "Welcome to ScrumpliCity",
        ogImageHeight: 2625,
        ogImageWidth: 5001,
      },
    },
    "/de/**": {
      seoMeta: {
        ogImage: "/og-image-de.png",
        ogImageAlt: "Willkommen bei ScrumpliCity",
        ogImageHeight: 2625,
        ogImageWidth: 5000,
      },
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
      "rooms/[id]/parent": {
        de: "/räume/[id]",
        en: "/rooms/[id]",
      },
      "rooms/[id]/parent/edit": {
        de: "/räume/[id]/bearbeiten",
        en: "/rooms/[id]/edit",
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
        en: "/play/[sprint]/build-phase",
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
    client: {
      initialRequest: false, // caution: without this initial request disabled, prerendering gets stuck in some kind of infinite loop and eventually runs out of memory
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
    broadcaster: "reverb",
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
  ogImage: {
    enabled: false,
  },
  app: {
    head: {
      templateParams: {
        separator: "|",
      },
      link: [
        {
          rel: "icon",
          type: "image/png",
          href: "/favicon-light.png",
          media: "(prefers-color-scheme: light)",
        },
        {
          rel: "icon",
          type: "image/png",
          href: "/favicon-dark.png",
          media: "(prefers-color-scheme: dark)",
        },
      ],
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
