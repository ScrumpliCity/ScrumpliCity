/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./app.vue",
    "./error.vue",
  ],
  theme: {
    colors: {
      'sc-orange': {
        50: '#FDF7EF',
        100: '#FAEDDA',
        200: '#F4D7B4',
        300: '#EDBC84',
        400: '#E49753',
        500: '#DE7C31',
        DEFAULT: 'CE6326',
        700: '#AC4D22',
        800: '#8A3E22',
        900: '#6F351F',
        950: '#3C190E',
      },
      'sc-yellow': {
        50: '#FBF8EB',
        100: '#F6EDCB',
        200: '#EFD999',
        300: '#E5BE5F',
        DEFAULT: 'E0AD49',
        500: '#CD8D25',
        600: '#B06D1E',
        700: '#8D4E1B',
        800: '#76401D',
        900: '#65361E',
        950: '#3A1B0E',
      },
      'sc-green': {
        50: '#F4F9F6',
        100: '#DBECE2',
        200: '#B7D8C6',
        DEFAULT: '8CDBA4',
        400: '#498369',
        500: '#498369',
        600: '#396853',
        700: '#305545',
        800: '#2A4539',
        900: '#263B32',
        950: '#12211C',
      },
      'sc-black': {
        50: '#F6F6F6',
        100: '#E7E7E7',
        200: '#D1D1D1',
        300: '#B0B0B0',
        400: '#888888',
        500: '#6D6D6D',
        600: '#5D5D5D',
        700: '#4F4F4F',
        800: '#454545',
        900: '#3D3D3D',
        DEFAULT: '030303'
      },
      'sc-white': {
        DEFAULT: 'FCFCFC'
      },
    },
    fontFamily: {
      sans: ["Manrope", "sans-serif"]
    }
  },
  plugins: [],
}
