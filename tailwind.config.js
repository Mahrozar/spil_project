/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#f0fdf9',
          100: '#ccfbf1',
          500: '#06b6d4',
        },
        brand: {
          DEFAULT: '#0f766e',
          700: '#0f766e'
        }
      },
      fontFamily: {
        sans: ['ui-sans-serif', 'system-ui', 'Inter', 'sans-serif']
      }
    },
  },
  plugins: [],
}
