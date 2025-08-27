import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',      // Client-side CSS (no Tailwind)
                'resources/css/admin.css',    // Admin-side CSS (with Tailwind)
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
