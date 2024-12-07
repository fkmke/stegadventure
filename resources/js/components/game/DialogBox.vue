<script setup>
const props = defineProps({
    content: String,
    character: String,
    onClick: Function,
});
</script>

<template>
    <div class="click" @click="onClick">
        <b>{{ character }}:</b> {{ content }}
    </div>
</template>

<style scoped>
.click {
    position: absolute;
    width: 100vw;
    height: 100vh;
    background-color: blueviolet;
}
</style>
