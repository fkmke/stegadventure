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
    // TODO send time in seconds since start of reading
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

        <h2>Cyber security</h2>
        <p>
            Introduction and importance.
        </p>

        <h3>Cryptography</h3>
        <p>
            Public and private key
        </p>

        <h3>Steganography</h3>
        <p>
            Art of hiding
        </p>
        <p>
            Slave + lemon juice + audio and PDF
        </p>

        <h2>Cryptography vs steganography</h2>
        <p>
            Art of hiding vs art of secret writing. + What do you want to achieve?
        </p>

        <h2>Relevance</h2>
        <p>
            Communication: terrorists 9/11 + social media on FB images or on eBay quite some images with steganography.
        </p>
        <p>
            Also, can be used for malware. More about this later. First image steganography.
        </p>

        <h2>Image steganography</h2>
        <h3>Hiding inside an image</h3>
        <p>
            Adjust pixels + note that pixels will be slightly adjusted
        </p>

        <h3>Stego key</h3>
        <p>Why stego key?</p>

        <h2>StegWare</h2>
        <p>
            Steganography Malware
        </p>
        <p>
            Steal credit card numbers
        </p>
        <p>
            Why? Hard to detect.
        </p>
        <p>
            Pseudocode
        </p>

        <div class="button">
            <Button text="I have read the text" :onClick="next" />
        </div>
    </TextTemplate>
</template>
