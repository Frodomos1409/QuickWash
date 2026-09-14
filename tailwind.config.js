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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#eefbff',
                    100: '#d9f4ff',
                    200: '#b7eaff',
                    300: '#7ddcff',
                    400: '#3cc6ff',
                    500: '#0aa8f0',
                    600: '#0086cc',
                    700: '#026ba5',
                    800: '#075988',
                    900: '#0c4a70',
                    950: '#082f4a',
                },
                foam: {
                    400: '#7ee8c9',
                    500: '#3fd6a8',
                },
            },
            boxShadow: {
                brand: '0 20px 40px -12px rgba(10, 168, 240, 0.35)',
                card: '0 1px 2px rgba(15, 23, 42, 0.04), 0 8px 24px -8px rgba(15, 23, 42, 0.08)',
            },
            backgroundImage: {
                'brand-gradient': 'linear-gradient(135deg, #0aa8f0 0%, #0670c9 55%, #063e82 100%)',
                'brand-radial': 'radial-gradient(circle at top left, rgba(255,255,255,0.25), transparent 55%)',
            },
            animation: {
                'fade-up': 'fade-up .5s ease-out both',
                float: 'float 6s ease-in-out infinite',
            },
            keyframes: {
                'fade-up': {
                    '0%': { opacity: 0, transform: 'translateY(12px)' },
                    '100%': { opacity: 1, transform: 'translateY(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
            },
        },
    },

    plugins: [forms],
};
