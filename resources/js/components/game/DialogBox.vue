<script setup>
import { ref } from 'vue';

const props = defineProps({
    node: Object,
    onClick: Function,
});

const hasRead = ref(false);

function handleOnClick() {
    if (props.node.type === 'TEXT') {
        props.onClick();
    }
    if (props.node.type === 'QUESTION') {
        hasRead.value = true;
    }
}

function handleOnClickAnswer(choice) {
    props.onClick(choice);
    hasRead.value = false;
}

</script>

<template>
    <div class="click" @click="handleOnClick">
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
    background-color: #00000050
}
</style>
