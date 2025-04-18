import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',     // ✅ ここはOK！
        emptyOutDir: true,
    },
    cacheDir: 'node_modules/.vite', // ✅ これを明示して .vite フォルダ外に出さないようにする
});


