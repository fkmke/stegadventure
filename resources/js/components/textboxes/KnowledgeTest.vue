<script setup>
import TextTemplate from '../TextTemplate.vue';
import Button from '../Button.vue';
import axios from 'axios';

const props = defineProps({
    experimentState: Number,
    participantId: String,
});

const emit = defineEmits(['update:experimentState']);
function next() {
    // TODO check if everything is filled in

    // TODO send inputs to back end

    // Then send has_finished=true to back end
    hasFinished();
}

function hasFinished() {
    const participant = {
        id: props.participantId,
    }
    axios.post('/api/participant/finish', participant)
        .then((response) => {
            console.log("The participant has finished the experiment.");
            // Go to next experiment state
            emit('update:experimentState', 4);
        })
        .catch(error => {
            console.error('Error finishing the participant\'s data:', error.response?.data.message);
        });
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
