import { createApp } from "vue";

import App from "./App.vue";
import router from "./plugins/router.js";
import vuetify from "./plugins/vuetify.js";

import axios from 'axios'
import VueAxios from 'vue-axios'

const app = createApp(App);
app.use(router).use(vuetify).use(VueAxios, axios).provide('axios', app.config.globalProperties.axios).mount("#app");


