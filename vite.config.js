// vite.config.js
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',       // Laravelが探す場所
        emptyOutDir: true,
    },
    // 👇 これがあると ".vite" の中に入ってしまう
    // cacheDir: 'node_modules/.vite' ← これ削除 or コメントアウト！！
})
