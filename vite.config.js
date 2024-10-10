import {defineConfig} from 'vite';
export default defineConfig({
  build: {
    emptyOutDir: false,
    manifest: true,
    rollupOptions: {
      input: ['resources/js/init.js', 'resources/css/ace.css'],
      output: {
        entryFileNames: `init.js`,
        assetFileNames: file => {
          let ext = file.name.split('.').pop()
          if (ext === 'css') {
            return 'ace.css'
          }

          return '[name].[ext]'
        }
      }
    },
    outDir: 'public',
  },
});
