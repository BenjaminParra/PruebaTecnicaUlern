import { createRouter, createWebHistory } from "vue-router";

import Registro from "../components/Registro.vue";
import Login from "../components/Login.vue";
import Perfil from "../components/Perfil.vue";

const routes = [
  {
    path: "/registro",
    name: "Registro",
    component: Registro,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
  {
    path: "/perfil",
    name: "Perfil",
    component: Perfil,
  },
  {
    path: "/",
    redirect: "/login",
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
