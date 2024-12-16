<script setup>
import TextTemplate from '../TextTemplate.vue';
import Button from '../Button.vue';
import axios from 'axios';
import { ref } from 'vue';

const props = defineProps({
    experimentState: Number,
    participantId: String,
});

// Answers
const question1 = ref([]); // checkbox
const question2 = ref([]); // checkbox
const question3 = ref([]); // checkbox
const question4 = ref(null); // radio button
const question5 = ref(null); // radio button
const question6 = ref([]); // checkbox
const question7 = ref([]); // checkbox
const question8 = ref(null); // radio button
const question9 = ref(null); // radio button

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
        <h2>Knowledge test</h2>
        <p>
            The following questions test whether the learning method you used was useful. There are two types of closed
            in this test questions:
        </p>
        <p>
        <ol>
            <li>Checkboxes (square): multiple answers may be correct.</li>
            <li>Radio buttons (circle): only one option is correct.</li>
        </ol>
        </p>
        <p>
            You will be reminded per question what answer is expected. Selecting a correct answer will increase your
            test score. Selecting a wrong answer will decrease your test score. Therefore, you can choose "I don't know"
            if you do not know the answer, which results into zero points for that question.
        </p>

        <!-- Question 1: Steganography vs cryptography -->
        <h3>Which of the following pictures are an example of <u>steganography</u>? Select all that apply.</h3>
        <div class="form-item">
            <input type="checkbox" id="q1.1" value="1" v-model="question1" />
            <label for="q1.1">
                Picture 1
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q1.2" value="2" v-model="question1" />
            <label for="q1.2">
                Picture 2
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q1.3" value="3" v-model="question1" />
            <label for="q1.3">
                Picture 3
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q1.4" value="4" v-model="question1" />
            <label for="q1.4">
                Picture 4
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q1.0" value="0" v-model="question1" />
            <label for="q1.0">
                I don't know
            </label>
        </div>

        <!-- Question 2: Steganography vs cryptography -->
        <h3>Which of the following pictures are an example of <u>cryptography</u>? Select all that apply.</h3>
        <div class="form-item">
            <input type="checkbox" id="q2.1" value="1" v-model="question2" />
            <label for="q2.1">
                Picture 1
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q2.2" value="2" v-model="question2" />
            <label for="q2.2">
                Picture 2
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q2.3" value="3" v-model="question2" />
            <label for="q2.3">
                Picture 3
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q2.4" value="4" v-model="question2" />
            <label for="q2.4">
                Picture 4
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q2.0" value="0" v-model="question2" />
            <label for="q2.0">
                I don't know
            </label>
        </div>

        <!-- Question 3: Steganography preferred over cryptography -->
        <h3>In which of the following situation(s) is steganography preferred over cryptography? Select all that apply.
        </h3>
        <div class="form-item">
            <input type="checkbox" id="q3.1" value="1" v-model="question3" />
            <label for="q3.1">
                When trying to hack a system by sending an email with an attachment.
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q3.2" value="2" v-model="question3" />
            <label for="q3.2">
                When filling in your password and sending it over the internet to the official website of the
                government.
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q3.3" value="3" v-model="question3" />
            <label for="q3.3">
                When storing sensitive financial records in a database.
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q3.4" value="4" v-model="question3" />
            <label for="q3.4">
                When communicating covertly in a country with strict censorship and surveillance.
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q3.5" value="5" v-model="question3" />
            <label for="q3.5">
                When transmitting militairly orders over a secure channel.
            </label>
        </div>
        <div class="form-item">
            <input type="checkbox" id="q3.0" value="0" v-model="question3" />
            <label for="q3.0">
                I don't know.
            </label>
        </div>

        <!-- Question 4: Byte stream -->
        <h3>
            In which of the following byte streams is the letter 'm' (binary: 001101) hidden when the Least Significant
            Bit is used for steganography? Select one option.
        </h3>
        <div class="form-item">
            <input type="radio" id="q4.1" value="1" v-model="question4" />
            <label for="q4.1">
                11110010 10000001 00111101
                <br>
                11001001 10100101 00001101
            </label>
        </div>
        <div class="form-item">
            <input type="radio" id="q4.2" value="2" v-model="question4" />
            <label for="q4.2">
                00001011 11111010 00011011
                <br>
                10110011 10001000 11100110
            </label>
        </div>
        <div class="form-item">
            <input type="radio" id="q4.3" value="3" v-model="question4" />
            <label for="q4.3">
                00110101 11101001 11001101
                <br>
                00111101 10110111 01111010
            </label>
        </div>
        <div class="form-item">
            <input type="radio" id="q4.4" value="4" v-model="question4" />
            <label for="q4.4">
                00101100 01011100 11111001
                <br>
                00011011 01011010 11011001
            </label>
        </div>
        <div class="form-item">
            <input type="radio" id="q4.5" value="5" v-model="question4" />
            <label for="q4.5">
                00001101 11110110 00000010
                <br>
                10011011 00010000 00100100
            </label>
        </div>
        <div class="form-item">
            <input type="radio" id="q4.0" value="0" v-model="question4" />
            <label for="q4.0">
                I don't know.
            </label>
        </div>


        <div class="button">
            <Button text="Next" :onClick="next" />
        </div>
    </TextTemplate>
</template>
