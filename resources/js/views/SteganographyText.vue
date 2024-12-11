<script setup>
import TextTemplate from '../components/TextTemplate.vue';
import Button from '../components/Button.vue';

const props = defineProps({
    experimentState: Number,
    participantId: String,
});

const emit = defineEmits(['update:experimentState']);
function next() {
    emit('update:experimentState', 2);
}

</script>

<template>
    <TextTemplate>
        <p>
            Hereby some information on steganography.
        </p>

        <div class="button">
            <Button text="I have read the text" :onClick="next" />
        </div>
    </TextTemplate>
</template>
