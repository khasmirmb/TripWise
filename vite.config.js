import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/admin.js',
                'resources/js/staff.js',
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/darkmode.js',
                'resources/js/elements.js',
                'resources/js/flowbite.js',
                'resources/css/app.css',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': 'jQuery'
        },
    },
});
