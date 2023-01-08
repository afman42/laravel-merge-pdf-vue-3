import "./bootstrap";
import { createApp } from "vue";
import App from "./App.vue";

const app = createApp({});
app.component("MyComponent", App);
app.mount("#app");
