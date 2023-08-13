/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./react-frontend/**/*.tsx",
  ],
  theme: {
    extend: {},
  },
  safelist: [
    "badge-primary",
    "badge-secondary",
    "badge-info",
    "badge-danger",
    "badge-success"
  ],
  plugins: [
    require('@tailwindcss/forms')
  ],
}
