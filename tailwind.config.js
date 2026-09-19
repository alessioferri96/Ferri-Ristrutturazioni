/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./*.html", "./assets/js/**/*.js"],
    theme: {
        extend: {
            colors: {
                primary: '#6EC1E4',
                'primary-dark': '#379BC5',
                secondary: 'rgb(40, 41, 43)',
                accent: '#61CE70',
                dark: '#000000',
                highlight: '#FFBC7D',
            },
            fontFamily: {
                sans: ['Roboto', 'sans-serif'],
                display: ['Oswald', 'sans-serif'],
            },
            container: {
                center: true,
                padding: '1rem',
                screens: {
                    '2xl': '1300px',
                },
            },
        }
    },
    plugins: [],
}
