import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Merriweather', 'serif', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                warm: {
                    light: '#F5E9DA',
                    DEFAULT: '#D9B99B',
                    dark: '#A9746E',
                    accent: '#C49E7F',
                    muted: '#BFA6A0',
                },
                nostalgic: {
                    light: '#F3E9E2',
                    DEFAULT: '#C9A798',
                    dark: '#8C6A63',
                    accent: '#B28C7E',
                    muted: '#A88B7B',
                },
            },
        },
    },

    plugins: [forms],
};
