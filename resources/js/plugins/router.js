import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Story from "../views/Story.vue";
import Game from "../views/Game.vue";
import SteganographyText from "../views/SteganographyText.vue";
import PageNotFound from "../views/404.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/story",
        name: "Story",
        component: Story,
    },
    {
        path: "/game",
        name: "Game",
        component: Game,
    },
    {
        path: "/text",
        name: "Text",
        component: SteganographyText,
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
