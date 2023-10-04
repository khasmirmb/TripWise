/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
        "./src/**/*.{html,js}",
        "./node_modules/tw-elements/dist/js/**/*.js"
      ],

      theme: {
          extend: {
              fontFamily: {
                  'body': [
                  'Inter', 
                  'ui-sans-serif', 
                  'system-ui', 
                  '-apple-system', 
                  'system-ui', 
                  'Segoe UI', 
                  'Roboto', 
                  'Helvetica Neue', 
                  'Arial', 
                  'Noto Sans', 
                  'sans-serif', 
                  'Apple Color Emoji', 
                  'Segoe UI Emoji', 
                  'Segoe UI Symbol', 
                  'Noto Color Emoji'
              ],
              'sans': [
                  'Inter', 
                  'ui-sans-serif', 
                  'system-ui', 
                  '-apple-system', 
                  'system-ui', 
                  'Segoe UI', 
                  'Roboto', 
                  'Helvetica Neue', 
                  'Arial', 
                  'Noto Sans', 
                  'sans-serif', 
                  'Apple Color Emoji', 
                  'Segoe UI Emoji', 
                  'Segoe UI Symbol', 
                  'Noto Color Emoji'
              ]
              },
              colors: {
                  primary: {"50":"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a","950":"#172554"}
              },
          },
      },
  
      plugins: [
        require('flowbite/plugin'),
        require("tw-elements/dist/plugin.cjs"),
      ],
      
      darkMode: 'class',
}
