// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    devtools: {enabled: true},
    css: ['~/assets/css/main.css'],
    compatibilityDate: '2024-09-14',
    postcss: {
        plugins: {
            tailwindcss: {},
            autoprefixer: {},
        },
    },
    ssr: true,
    app: {
        head: {
            link: [
                {rel: 'icon', type: 'image/png', href: '/favicon.png'}
            ]
        }
    }
})