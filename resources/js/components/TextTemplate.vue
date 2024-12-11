<script setup>
const props = defineProps({
    title: {
        type: String,
        default: "StegAdventure"
    },
});
</script>

<template>
    <div id="background">
        <div class="text-object title">
            <h1>{{ title }}</h1>
        </div>
        <div class="text-object">
            <slot />
        </div>
    </div>
</template>

<style scoped>
#background {
    background-image: url('/backgrounds/sun-tornado.svg');
    background-position: top;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    height: 100%;
    min-height: 100vh;
    padding-top: var(--standard-distance);
    padding-bottom: var(--standard-distance);
}

.text-object {
    padding: var(--standard-padding);
    background-color: var(--primary-container);
    color: var(--on-primary-container);
    width: var(--page-width);
    max-width: var(--max-object-width);
    margin: auto;
    border-radius: var(--rounded-big);
    margin-bottom: var(--standard-padding);
    border: var(--border-width) solid var(--secondary);
}

.title {
    background-color: var(--secondary-container);
    color: var(--on-secondary-container);
}
</style>
