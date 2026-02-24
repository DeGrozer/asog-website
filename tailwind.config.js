/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './app/**/*.{php,html}',
    './app/Views/**/*.{php,html}',
    './public/**/*.html',
  ],
  theme: {
    extend: {
      colors: {
        navy: '#03558C',
        gold: '#F8AF21',
        'gold-dk': '#e8a900',
        sky: '#43A7DB',
        dark: '#020d18',
        off: '#F8F6F2',
      },
      fontFamily: {
        display: ['"DM Serif Display"', 'serif'],
        body: ['"DM Sans"', 'sans-serif'],
      },
      backdropBlur: {
        base: '16px',
      },
      zIndex: {
        90: '90',
        100: '100',
      },
    },
  },
  plugins: [],
};
