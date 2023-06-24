import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/site/app.scss',
                'resources/css/admin/app.scss',
                'resources/js/admin/app.js',
                'resources/js/site/app.js',
            ],
            refresh: true,
        }),
    ],
});
