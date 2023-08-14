import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";
import react from "@vitejs/plugin-react";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
  plugins: [
    laravel({
      input: "resources/js/app.tsx",
      refresh: true,
    }),
    react(),
    vue(),
  ],
  resolve: {
    alias: { "@react-src": path.resolve(__dirname, "react-frontend") },
  },
});
