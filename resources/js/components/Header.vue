<script setup>
import { ref } from 'vue';
import { RouterLink } from 'vue-router';
import NavButton from './NavButton.vue';


// Navigation drawer script

const drawer = ref(false);

const navItems = [
    {
        title: 'Home',
        path: '/',
    },
];

</script>

<template>
    <nav>
        <v-app-bar scroll-behavior="elevate" scroll-threshold="0">
            <div>

                <!-- HAMBURGER MENU -->
                <div v-if="$vuetify.display.smAndDown">
                    <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer" />
                </div>

                <!-- LOGO -->
                <div class="logo">

                    <RouterLink to="/">
                        <img src="" alt="logo" />
                    </RouterLink>
                </div>

                <v-spacer />

                <!-- Medium and up pages -->
                <div v-if="$vuetify.display.mdAndUp">
                    <NavButton v-for="nav in navItems" :text="nav.title" :route="nav.path" />
                </div>


            </div>
        </v-app-bar>

        <!-- Navigation drawer -->
        <v-navigation-drawer v-model="drawer" :location="bottom" temporary>
            <v-list>
                <v-list-item v-for="nav in navItems" :to="nav.path">{{ nav.title }}</v-list-item>
            </v-list>
        </v-navigation-drawer>

    </nav>
</template>

<style scoped>
img {
    height: var(--logo-header-height);
    max-width: 100%;
}
</style>
