import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import PageNotFound from "../views/404.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/:pathMatch(.*)*",
        name: "404 - Page not found",
        component: PageNotFound,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
