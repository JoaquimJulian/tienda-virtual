import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./src/**/*.{html,js}",
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Quicksand', 'sans-serif'],
            },
            colors: {
                naranja: '#EA580C',
                beig: '#FFEDD5',
                marron: '#7C2D12',
                carne: '#FDBA74',
                beigoscuro: '#E5E7EB',
                beigclaro: '#fff7ed',
            },
        },
    },
    

    plugins: [forms],
};
