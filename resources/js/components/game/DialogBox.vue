<script setup>
import { ref, onMounted, onBeforeUnmount, nextTick } from 'vue';

const props = defineProps({
    node: Object,
    name: String,
    onClick: Function,
});

const hasRead = ref(false);

// Styling
const backgroundContainer = ref(null);
const backgroundImage = ref(null);
const fontSize = ref('28px');

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

// Replaces ${something} by its value.
// Example template: "Hello, ${name}! You have ${count} new messages."
// Example values: { name: "Alice", count: 5 }
function replacePlaceholders(template, values) {
    return template.replace(/\$\{(\w+)\}/g, (match, key) => {
        return key in values ? values[key] : match;
    });
}

// Returns the text shown to the user.
function getContent() {
    return replacePlaceholders(props.node.content, { name: props.name });
}

function imagePath() {
    return "/backgrounds/dub/1.png";
}

// Function used to update the background for different screen sizes
function updateContainerSize() {
    nextTick(() => {
        console.log("tick")
        const img = backgroundImage.value;
        const container = backgroundContainer.value;

        if (!img || !container) return;

        // Calculate visible dimensions
        const { naturalWidth, naturalHeight } = img;
        const aspectRatio = naturalWidth / naturalHeight;
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;

        let width, height;
        if (viewportWidth / viewportHeight > aspectRatio) {
            // Screen is wider than the image
            height = viewportHeight;
            width = viewportHeight * aspectRatio;
        } else {
            // Screen is taller than the image
            width = viewportWidth;
            height = viewportWidth / aspectRatio;
        }

        // Apply visible dimensions to the container
        container.style.width = `${width}px`;
        container.style.height = `${height}px`;

        // Function to update font size on different screen sizes
        if (backgroundImage.value) {
            const height = backgroundImage.value.clientHeight;
            fontSize.value = `${height * 0.035}px`; // Set font-size to 10% of background image height
        }
    });
}

onMounted(() => {
    window.addEventListener("resize", updateContainerSize);
    updateContainerSize();
});

onBeforeUnmount(() => {
    window.removeEventListener("resize", updateContainerSize);
});

</script>

<template>
    <div class="click noselect" @click="handleOnClick">
        <div ref="backgroundContainer" class="background-container">
            <img ref="backgroundImage" class="background-image" :src="imagePath()" @load="updateContainerSize" />
            <!-- Type TEXT & Type QUESTION -->
            <p class="text" :style="{ fontSize }">
                <b>{{ node.character }}:</b> {{ getContent() }}
            </p>
            <!-- Type QUESTION -->
            <div v-if="hasRead" class="choices">
                <div v-for="choice in node.choices" :key="choice.text" class="choice" :style="{ fontSize }"
                    @click="handleOnClickAnswer(choice)">
                    {{ choice.text }}
                </div>
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
    background-color: black;
}

.background-container {
    position: relative;
    margin: auto;
    overflow: hidden;
    display: inline-block;
}

.background-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
}

.text {
    color: white;
    position: absolute;
    top: 80%;
    right: 20%;
    /* font-size: min(2.5vw, 3.5vh); */
    display: block;
}

.choices {
    display: grid;
    max-width: 50%;
    min-width: 30%;
    position: absolute;
    bottom: 25%;
    right: 10%;
    /* font-size: min(2vw, 3vh); */
    display: block;
}

.choice {
    margin: 5%;
    padding: 5%;
    border: 0.2vh white solid;
    border-radius: 10px;
    color: white;
    background-color: #00000050;
    cursor: pointer;
    text-align: right;
}
</style>
