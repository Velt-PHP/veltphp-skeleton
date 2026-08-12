/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.velt.php',
    './features/**/*.php',
    './routes/**/*.php',
  ],
  theme: {
    extend: {
      colors: {
        velt: {
          blue: '#2563eb',
          sky: '#38bdf8',
          ink: '#0f172a',
        },
      },
      fontFamily: {
        sans: ['Google Sans Flex', 'sans-serif'],
      },
      backgroundImage: {
        'velt-grid': 'linear-gradient(to right, rgba(37, 99, 235, 0.07) 1px, transparent 1px), linear-gradient(to bottom, rgba(37, 99, 235, 0.07) 1px, transparent 1px)',
        'github-mark': 'url("data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%230f172a%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3E%3Cpath d=%27M15 22v-4a4.8 4.8 0 0 0-1-3.5c3.3-.4 6.8-1.6 6.8-7A5.4 5.4 0 0 0 19.4 4 5 5 0 0 0 19.3.5S18.2.1 15 1.8a13.4 13.4 0 0 0-7 0C4.8.1 3.7.5 3.7.5A5 5 0 0 0 3.6 4a5.4 5.4 0 0 0-1.4 3.7c0 5.4 3.5 6.6 6.8 7A4.8 4.8 0 0 0 8 18v4%27/%3E%3Cpath d=%27M8 19c-3 .9-3-1.5-4-2%27/%3E%3C/svg%3E")',
      },
      backgroundSize: {
        grid: '32px 32px',
      },
      borderRadius: {
        DEFAULT: '8px',
      },
    },
  },
  plugins: [],
};
