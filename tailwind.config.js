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
        'itc-garamond': ['"itc-garamond"'],
        'optima': ['"optima"'],
      },
    },
    backgroundColor: theme => ({
     ...theme('colors'),
     'primary': '#92c8c2',
     'secondary': '#ebe6dc',
     'tertiary': '#f1d27a',
     'offblack': '#333',
    }),
    textColor: theme => theme('colors'),
     textColor: {
       'primary': '#92c8c2',
       'secondary': '#ebe6dc',
       'tertiary': '#f1d27a',
       'offblack': '#333',
     },
     borderColor: theme => ({
       ...theme('colors'),
        DEFAULT: theme('colors.gray.300', 'currentColor'),
       'primary': '#92c8c2',
       'secondary': '#ebe6dc',
       'tertiary': '#f1d27a',
       'offblack': '#333',
      }),
     boxShadow: {
      sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
      DEFAULT: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
      md: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
      lg: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
      xl: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
      '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
     '3xl': '0 35px 60px -15px rgba(0, 0, 0, 0.3)',
      inner: 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
      'hard': '2px 2px 2px rgb(0 0 0 / 75%)',
      none: 'none',
    },
    borderWidth: {
        DEFAULT: '1px',
        '0': '0',
        '2': '2px',
        '3': '3px',
        '4': '4px',
        '5': '5px',
        '6': '6px',
        '8': '8px',
      }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
