<script setup>
import TextTemplate from '../TextTemplate.vue';
import Button from '../Button.vue';

const props = defineProps({
    experimentState: Number,
    participantId: String,
});

const emit = defineEmits(['update:experimentState']);
function next() {
    emit('update:experimentState', 5);
}
</script>

<template>
    <TextTemplate>
        <p>
            Hereby some space to give some optional feedback.
        </p>

        <div class="button">
            <Button text="Next" :onClick="next" />
        </div>
    </TextTemplate>
</template>
