import Vue from "vue";
import VueI18n from "vue-i18n";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import VueFlashMessage from "vue-flash-message";
import "vue-flash-message/dist/vue-flash-message.min.css";
import GlobalFunctions from "./plugins/globalFunctions";
import { AclInstaller, AclCreate } from "vue-acl";
import VueCurrencyInput from "vue-currency-input";
import dictionary from "./utils/dictionary";

const pluginOptions = {
  /* see config reference */
  globalOptions: { currency: "BRL" },
  "auto-decimal-mode": true,
  "distraction-free": false,
};
Vue.use(VueCurrencyInput, pluginOptions);
Vue.use(AclInstaller);
Vue.use(VueFlashMessage);
Vue.use(VueSweetalert2);
Vue.use(GlobalFunctions);
Vue.config.productionTip = false;
Vue.use(VueI18n);

/* Instanciando o vue acl (Permissões) */
const acl = new AclCreate({
  initial: "public",
  notfound: "/",
  router,
  acceptLocalRules: false,
});

const i18n = new VueI18n({
  locale: "pt-BR",
  messages: dictionary,
});

new Vue({
  router,
  store,
  acl,
  i18n,
  render: (h) => h(App),
}).$mount("#app");
