import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class', // Menggunakan class untuk dark mode
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    "50": "#eff6ff",
                    "100": "#dbeafe",
                    "200": "#bfdbfe",
                    "300": "#93c5fd",
                    "400": "#60a5fa",
                    "500": "#3b82f6",
                    "600": "#2563eb",
                    "700": "#1d4ed8",
                    "800": "#1e40af",
                    "900": "#1e3a8a",
                    "950": "#172554"
                },
                red: {
                    "50": "#fef2f2",
                    "100": "#fee2e2",
                    "200": "#fecaca",
                    "300": "#fca5a5",
                    "400": "#f87171",
                    "500": "#ef4444",
                    "600": "#dc2626",
                    "700": "#b91c1c",
                    "800": "#991b1b",
                    "900": "#7f1d1d",
                    "950": "#450a0a"
                },
                orange: {
                    "50": "#fff7ed",
                    "100": "#ffedd5",
                    "200": "#fed7aa",
                    "300": "#fdba74",
                    "400": "#fb923c",
                    "500": "#f97316",
                    "600": "#ea580c",
                    "700": "#c2410c",
                    "800": "#9a3412",
                    "900": "#7c2d12",
                    "950": "#431407"
                }
            },
            fontFamily: {
                sans: [
                    'Figtree',
                    'Inter',
                    ...defaultTheme.fontFamily.sans,
                ],
                body: [
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
                    'Noto Color Emoji',
                ],
            },
        },
    },
    plugins: [
        require('flowbite-typography'),
    ],
};
