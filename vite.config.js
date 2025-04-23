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
        outDir: 'public/build',     // Laravel が探すディレクトリ
        manifest: true,
        emptyOutDir: true,
    },
    // cacheDir は不要！コメントアウトまたは削除！
    // cacheDir: 'node_modules/.vite',
})
