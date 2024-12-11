<script setup>
const props = defineProps({
    onclick: Function,
    text: String,
});
</script>

<template>
    <div @click="onclick">{{ text }}</div>
</template>

<style scoped>
div {
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: var(--standard-padding);
    padding-right: var(--standard-padding);
    min-width: 200px;
    border-radius: var(--rounded-big);
    background-color: var(--primary);
    color: var(--on-primary);
    text-transform: uppercase;
    font-weight: 700;
    text-align: center;
    width: fit-content;
    cursor: pointer;
}
</style>
