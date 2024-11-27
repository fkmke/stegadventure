<script setup>

// text: the text visible on the nav button
// route: the route path (e.g. '/contact')
const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    route: {
        type: String,
        required: true,
    }
});

</script>

<template>
    <v-btn variant="text" :to="props.route">
        {{ props.text }}
    </v-btn>
</template>

<style scoped></style>
