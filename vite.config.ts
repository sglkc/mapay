import { resolve } from 'node:path';
import { defineConfig } from 'vite';
import preact from '@preact/preset-vite';
import unocss from 'unocss/vite';

// https://vitejs.dev/config/
export default defineConfig({
  root: resolve(__dirname, 'client'),
  envDir: __dirname,
  build: {
    outDir: '../dist/client',
    emptyOutDir: true,
  },
  plugins: [
    preact(),
    unocss(),
  ],
});
