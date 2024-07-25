/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    container:{
      center: true,
    },extend: {
      colors : {
        primary: '#F8F7F3',
        secondary:'#999999',
        third:'#F0EEE5',
        fourth: '#3C4043',
        fifth: '#BAE6FF',
        redBtn: '#C53F3F',
        blueBtn: '#407BFF',
      },
      fontFamily: {
        'MadeTomy-Light': ['MadeTomy-Light'],
        'MadeTomy-Thin': ['MadeTomy-Thin'],
        'MadeTomy-Regular': ['MadeTomy-Regular'],
        'MadeTomy-Medium': ['MadeTomy-Medium'],
        'MadeTomy-Bold': ['MadeTomy-Bold'],
        'MadeTomy-ExtraBold': ['MadeTomy-ExtraBold'],
      },
    },
  },
  plugins: [],
}