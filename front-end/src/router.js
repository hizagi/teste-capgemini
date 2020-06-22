import Vue from "vue";
import VueRouter from "vue-router";
import { AclRule } from "vue-acl";
import store from "./store";
import Login from "./views/Login/Login.vue";
import Template from "./components/Template.vue";
import Home from "./views/Home/Home.vue";
import Deposit from "./views/Deposit/Deposit.vue";
import Withdraw from "./views/Withdraw/Withdraw.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/login",
    name: "login",
    component: Login,
    meta: {
      rule: new AclRule("public").generate(),
    },
  },
  {
    path: "/",
    component: Template,
    meta: {
      requiresAuth: true,
      rule: new AclRule("public").generate(),
    },
    children: [
      /**Rotas Internas */
      {
        path: "",
        alias: "home",
        name: "Home",
        meta: {
          description: "Sua Conta",
          rule: new AclRule("account.index").generate(),
        },
        component: Home,
        children: [
          {
            path: "deposit",
            alias: "deposit",
            name: "Deposit",
            meta: {
              description: "Sua Conta",
              rule: new AclRule("account.deposit").generate(),
            },
            component: Deposit,
          },
          {
            path: "withdraw",
            alias: "withdraw",
            name: "Withdraw",
            meta: {
              description: "Sua Conta",
              rule: new AclRule("account.withdraw").generate(),
            },
            component: Withdraw,
          },
        ],
      },
    ],
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  linkExactActiveClass: "active",
  routes,
});

/* Middleware executado antes de prosseguir pra rota solicitada */
router.beforeEach(async (to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    // Se o parametro meta.requiresAuth da rota solicitada for true
    if (localStorage.getItem(store.state.TOKEN_KEY)) {
      // Se já existir token de autenticação no storage
      next(); // Prossiga pra rota solicitada
    } else {
      console.log("Não autenticado!");
      next({ path: "/login" }); // Retorna pro componente login
    }
  } else {
    // Se a rota não estiver protegida (requiresAuth)
    next(); // Prossiga pra rota solicitada
  }
});

export default router;
