import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";
import path from "path";

export default defineConfig({
  plugins: [
    laravel([
      "frontend/app.tsx",
    ]),
    react(),
  ],
  resolve: {
    alias: { "@src": path.resolve(__dirname, "frontend") },
  },
});
