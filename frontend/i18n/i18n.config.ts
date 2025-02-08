export default defineI18nConfig(() => ({
  legacy: false,
  locale: "de",
  fallbackLocale: "de",
  datetimeFormats: {
    de: {
      short: {
        month: "short",
        day: "numeric",
      },
      custom: {
        year: "numeric",
        month: "short",
        day: "numeric",
      },
    },
    en: {
      short: {
        month: "short",
        day: "numeric",
      },
      custom: {
        year: "numeric",
        month: "short",
        day: "numeric",
      },
    },
  },
}));
