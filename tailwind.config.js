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
        sans: ['Google Sans Flex', 'Poppins', 'system-ui', 'sans-serif'],
      },
      borderRadius: {
        DEFAULT: '8px',
      },
    },
  },
  plugins: [],
};
