module.exports = {
  purge: {
    enabled: true,
    content: ['./resources/**/*.blade.php',
     './resources/**/*.js',
     './resources/**/*.vue',
     ],
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontFamily: {
        'gastromond': ['"gastromond"'],
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
