const colors = require("tailwindcss/colors");
/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./*.php",
        "./merchants/**/*.{php,js}",
        "./admin/**/*.{php,js}",
        "./shop/**/*.{php,js}",
        "./customers/**/*.{php,js}",
        "./shipping_company/**/*.{php,js}",
    ],
    theme: {
        extend: {
            colors: {
                'viridian-green': {
                    '50': '#f2fdf4',
                    '100': '#ebf2f3',
                    '200': '#c8e4de',
                    '300': '#a7c3b4',
                    '400': '#6b917f',
                    '500': '#537968',
                    '600': '#3a6150',
                    '700': '#2f4d41',
                    '800': '#273e35',
                    '900': '#20342b',
                    '950': '#111d18',
                },
            },
        },

    },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
    ],
}

