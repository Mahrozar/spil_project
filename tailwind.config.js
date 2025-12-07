/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    // include css so classes used with @apply in CSS are discovered
    './resources/css/**/*.css',
  ],
  // Always generate these utility classes (useful when classes are only used via @apply)
  safelist: [
    'bg-primary',
    'bg-secondary',
    'text-primary',
    'text-white',
    'bg-primary/5',
    'bg-white/5'
  ],
  theme: {
    extend: {
      colors: {
        primary: { DEFAULT: '#1e40af' },
        secondary: { DEFAULT: '#3b82f6' },
        accent: { DEFAULT: '#10b981' },
        dark: { DEFAULT: '#1f2937' },
        light: { DEFAULT: '#f8fafc' },
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
