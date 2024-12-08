<script setup>
import { ref } from 'vue';

const props = defineProps({
    node: Object,
    onClick: Function,
});

const hasRead = ref(false);

function handleOnClick() {
    // Go to next node
    if (props.node.type === 'TEXT') {
        props.onClick();
    }
    // Show answers
    if (props.node.type === 'QUESTION') {
        hasRead.value = true;
    }
}

function handleOnClickAnswer(choice) {
    // Return choice and reset hasRead value
    props.onClick(choice);
    hasRead.value = false;
}

</script>

<template>
    <div class="click noselect" @click="handleOnClick">
        <!-- Type TEXT & Type QUESTION-->
        <p class="text">
            <b>{{ node.character }}:</b> {{ node.content }}
        </p>
        <!-- Type QUESTION -->
        <div v-if="hasRead" class="choices">
            <div v-for="choice in node.choices" :key="choice.text" class="choice" @click="handleOnClickAnswer(choice)">
                {{ choice.text }}
            </div>
        </div>
    </div>
</template>

<style scoped>
.noselect {
    /* iOS Safari */
    -webkit-touch-callout: none;
    /* Safari */
    -webkit-user-select: none;
    /* Konqueror HTML */
    -khtml-user-select: none;
    /* Old versions of Firefox */
    -moz-user-select: none;
    /* Internet Explorer/Edge */
    -ms-user-select: none;
    /* Non-prefixed version, currently supported by Chrome, Edge, Opera and Firefox */
    user-select: none;
}

.click {
    position: absolute;
    width: 100vw;
    height: 100vh;
    background-color: blue;
}

.text {
    color: white;
    padding: 20px;
}

.choices {
    display: grid;
    max-width: 400px;
    gap: 10px;
}

.choice {
    padding: 20px;
    border: 4px white solid;
    border-radius: 20px;
    color: white;
    background-color: #00000050;
    cursor: pointer;
}
</style>
