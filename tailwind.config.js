import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                brand: ['Inter', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                brand: {
                    blue: '#1E3A8A',
                    emerald: '#10B981',
                    orange: '#F97316',
                    gray: '#6B7280',
                    dark: '#0B1220',
                    ink: '#111827',
                    light: '#F8FAFC',
                },
            },

            boxShadow: {
                soft: '0 20px 60px -30px rgba(15, 23, 42, 0.35)',
                brand: '0 24px 70px -35px rgba(30, 58, 138, 0.45)',
                orange: '0 24px 70px -35px rgba(249, 115, 22, 0.45)',
            },

            borderRadius: {
                brand: '1.75rem',
            },

            animation: {
                'fade-up': 'fadeUp 0.75s ease both',
                'float': 'float 10s ease-in-out infinite',
                'shimmer': 'shimmer 6s linear infinite',
                'pulse-soft': 'pulseSoft 2.8s ease-in-out infinite',
            },

            keyframes: {
                fadeUp: {
                    '0%': { opacity: '0', transform: 'translateY(18px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-18px)' },
                },
                shimmer: {
                    '0%': { transform: 'translateX(-100%)' },
                    '100%': { transform: 'translateX(100%)' },
                },
                pulseSoft: {
                    '0%, 100%': { transform: 'scale(1)', opacity: '1' },
                    '50%': { transform: 'scale(1.02)', opacity: '0.96' },
                },
            },
        },
    },

    plugins: [forms, typography],
};
