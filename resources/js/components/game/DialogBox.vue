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
const fontSizeText = ref('28px');
const fontSizeChoice = ref('20px');

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
            fontSizeText.value = `${height * 0.035}px`; // Set font-size to 10% of background image height
            fontSizeChoice.value = `${height * 0.030}px`;
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
            <p class="text" :style="{ fontSize: fontSizeText }">
                <b>{{ node.character }}:</b> {{ getContent() }}
            </p>
            <!-- Type QUESTION -->
            <div v-if="hasRead" class="choices"
                :style="node.choices.length > 5 ? { gridTemplateColumns: '1fr 1fr' } : {}">
                <div />
                <div v-for="choice in node.choices" :key="choice.text" class="choice"
                    :style="{ fontSize: fontSizeChoice }" @click="handleOnClickAnswer(choice)">
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
    overflow: hidden;
}

.background-container {
    position: relative;
    margin: auto;
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
    left: 35%;
    display: block;
    max-width: 56%;
}

.choices {
    display: grid;
    position: absolute;
    bottom: 22.5%;
    right: 5%;
    gap: 10px;
    max-width: 40%;
}

.choice {
    min-width: fit-content;
    width: 100%;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 5px;
    padding-bottom: 5px;
    border: 0.2vh white solid;
    border-radius: 10px;
    color: white;
    background-color: #00000090;
    cursor: pointer;
    text-align: right;
}
</style>
