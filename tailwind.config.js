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
                sans: ['Pixelate', 'Merriweather', 'serif', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                warm: {
                    light: '#FDEBD0',      // softer light beige
                    DEFAULT: '#D4A373',    // warm terracotta
                    dark: '#A0522D',       // sienna brown
                    accent: '#E07A5F',     // coral accent
                    muted: '#C9B29B',      // muted sand
                },
                nostalgic: {
                    light: '#E9D8A6',      // soft yellow
                    DEFAULT: '#C1A57B',    // warm tan
                    dark: '#7B6D5A',       // muted brown
                    accent: '#D4B483',     // light caramel
                    muted: '#BFAF91',      // muted beige
                },
            },
        },
    },

    plugins: [forms],
};
