<script setup>
import TextTemplate from '../components/TextTemplate.vue';
import Button from '../components/Button.vue';
import axios from 'axios';

const props = defineProps({
    experimentState: Number,
    participantId: String,
});

const emit = defineEmits(['update:experimentState']);
function next() {
    const read = {
        participant_id: props.participantId,
        time_since_start: 0,
    }
    axios.post('/api/reading/add', read)
        .then((response) => {
            console.log("The reading time has been saved.");
            emit('update:experimentState', 2);
        })
        .catch(error => {
            console.error('Error saving the reading time:', error.response?.data.message);
        });
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
