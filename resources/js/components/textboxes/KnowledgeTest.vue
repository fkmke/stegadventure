<script setup>
import TextTemplate from '../TextTemplate.vue';
import Button from '../Button.vue';

const props = defineProps({
    experimentState: Number,
    participantId: String,
});

const emit = defineEmits(['update:experimentState']);
function next() {
    emit('update:experimentState', 4);
}
</script>

<template>
    <TextTemplate>
        <p>
            Hereby the knowledge test.
        </p>

        <div class="button">
            <Button text="Next" :onClick="next" />
        </div>
    </TextTemplate>
</template>
