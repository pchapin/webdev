import { defineConfig } from 'vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import { defineConfig as defineVitestConfig } from 'vitest/config';

export default defineConfig({
  root: '.',
  build: {
    outDir: 'dist',
    sourcemap: true, // Helpful for debugging.
    target: 'esnext', // Modern browser support.
  },
  test: {
    globals: true, // For using global test functions like `describe`, `it`, `expect`.
    environment: 'jsdom', // Or 'node' if you're testing backend code.
  },
});
