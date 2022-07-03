import { fileURLToPath, URL } from "url";

import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import { VitePWA } from "vite-plugin-pwa";

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    VitePWA({
      registerType: "autoUpdate",
      includeAssets: ["favicon.ico", "icon-low.png", "icon-high.png"],
      manifest: {
        name: "Clock 2 - Oats Jenkins",
        short_name: "clock-2",
        description:
          "See what time it is on the improved clock of Oats Jenkins.",
        theme_color: "#ffffff",
        icons: [
          {
            src: "icon-low.png",
            sizes: "48x48",
            type: "image/png",
          },
          {
            src: "icon-med.png",
            sizes: "192x192",
            type: "image/png",
          },
          {
            src: "icon-high.png",
            sizes: "512x512",
            type: "image/png",
          },
        ],
      },
    }),
  ],
  resolve: {
    alias: {
      "@": fileURLToPath(new URL("./src", import.meta.url)),
    },
  },
});
