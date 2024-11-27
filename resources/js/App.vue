<script setup>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
</script>

<template>
    <v-app>
        <Header style="margin-bottom: var(--header-height);" />

        <RouterView />

        <v-spacer />
        <Footer style="margin-top: var(--standard-read-margin);" />
    </v-app>
</template>
