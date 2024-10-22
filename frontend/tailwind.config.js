/** @type {import('tailwindcss').Config} */
export default {
    content: [
        `components/**/*.{vue,js,ts}`,
        `layouts/**/*.vue`,
        `pages/**/*.vue`,
        `composables/**/*.{js,ts}`,
        `plugins/**/*.{js,ts}`,
        `utils/**/*.{js,ts}`,
        `App.{js,ts,vue}`,
        `app.{js,ts,vue}`,
        `Error.{js,ts,vue}`,
        `error.{js,ts,vue}`,
        `app.config.{js,ts}`,
    ],
    theme: {
        extend: {
            colors: {
                "sc-orange": {
                    50: "#FDF7EF",
                    100: "#FAEDDA",
                    200: "#F4D7B4",
                    300: "#EDBC84",
                    400: "#E49753",
                    500: "#DE7C31",
                    DEFAULT: "#CE6326",
                    700: "#AC4D22",
                    800: "#8A3E22",
                    900: "#6F351F",
                    950: "#3C190E",
                },
                "sc-yellow": {
                    50: "#FBF8EB",
                    100: "#F6EDCB",
                    200: "#EFD999",
                    300: "#E5BE5F",
                    DEFAULT: "#E0AD49",
                    500: "#CD8D25",
                    600: "#B06D1E",
                    700: "#8D4E1B",
                    800: "#76401D",
                    900: "#65361E",
                    950: "#3A1B0E",
                },
                "sc-green": {
                    50: "#F2FBF4",
                    100: "#E1F7E8",
                    200: "#C5EDD1",
                    DEFAULT: "#8CDBA4",
                    400: "#61C780",
                    500: "#3CAB5F",
                    600: "#2C8D4A",
                    700: "#266F3D",
                    800: "#235834",
                    900: "#1E492D",
                    950: "#0C2715",
                },
                "sc-black": {
                    50: "#F6F6F6",
                    100: "#E7E7E7",
                    200: "#D1D1D1",
                    300: "#B0B0B0",
                    400: "#888888",
                    500: "#6D6D6D",
                    600: "#5D5D5D",
                    700: "#4F4F4F",
                    800: "#454545",
                    900: "#3D3D3D",
                    DEFAULT: "#030303",
                },
                "sc-white": {DEFAULT: "#FCFCFC"},
            },
            fontFamily: {
                sans: ["Manrope", "sans-serif"],
                KelsonRegular: ["Kelson-Regular", "sans-serif"],
                KelsonBold: ["Kelson-Bold", "sans-serif"],
                KelsonExtraBold: ["Kelson-ExtraBold", "sans-serif"],
                KelsonLight: ["Kelson-Light", "sans-serif"],
                KelsonMedium: ["Kelson-Medium", "sans-serif"],
                KelsonThin: ["Kelson-Thin", "sans-serif"],
            },
        },
    },
    plugins: [],
};
