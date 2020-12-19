import Vue from "vue";
import App from "./App.vue";
import router from "./routes";
// import store from "./store";
// import BootstrapVue from "bootstrap-vue/dist/bootstrap-vue.esm";
// import "bootstrap/dist/css/bootstrap.css";
// import "bootstrap-vue/dist/bootstrap-vue.css";

Vue.config.productionTip = false;

// Vue.use(BootstrapVue);

// Vue.component("pagination", require("laravel-vue-pagination"));

new Vue({ render: h => h(App), router /* store */ }).$mount("#app");
