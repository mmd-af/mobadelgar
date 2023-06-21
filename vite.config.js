import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/site/app.scss',
                'resources/sass/admin/app.scss',
                'resources/js/admin/app.js',
                'resources/js/site/app.js',
            ],
            refresh: true,
        }),
        react(),
    ],
});
