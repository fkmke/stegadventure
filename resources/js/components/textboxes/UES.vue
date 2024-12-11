<script setup>
import TextTemplate from '../TextTemplate.vue';
import Button from '../Button.vue';
import { onMounted } from 'vue';

const props = defineProps({
    experimentState: Number,
    participantId: String,
});

const emit = defineEmits(['update:experimentState']);
function next() {
    emit('update:experimentState', 3);
}

function exitFullScreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();  // Firefox
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();  // Chrome, Safari
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();  // Internet Explorer
    }
}

onMounted(exitFullScreen);
</script>

<template>
    <TextTemplate>
        <p>
            Hereby the UES form.
        </p>

        <div class="button">
            <Button text="Next" :onClick="next" />
        </div>
    </TextTemplate>
</template>
