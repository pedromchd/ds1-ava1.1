/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php"],
  theme: {
    extend: {
      animation: {
        dvd: 'hue 7.75s linear infinite, moveX 2.25s linear infinite alternate, moveY 3.75s linear infinite alternate'
      },
      keyframes: {
        hue: {
          'to': { filter: 'hue-rotate(360deg)' }
        },
        moveX: {
          'from': { left: 0 },
          'to': { left: 'calc(100vw - var(--dvd-width))' }
        },
        moveY: {
          'from': { top: 0 },
          'to': { top: 'calc(100vh - var(--dvd-heigth))' }
        }
      },
      fontFamily: {
        'cinzel': ['"Cinzel Decorative"', 'cursive'],
        'monoton': ['"Monoton"', 'cursive'],
        '2p': ['"Press Start 2P"', 'cursive']
      }
    },
  },
  plugins: [],
}
