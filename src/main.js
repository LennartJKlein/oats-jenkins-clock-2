import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./App.vue";
import VueGtag from "vue-gtag";

const app = createApp(App);

app.use(createPinia());

app.use(VueGtag, {
  config: { id: "G-0XVDJ5VXB5" },
  params: {
    anonymize_ip: true,
  },
});

app.mount("#app");
