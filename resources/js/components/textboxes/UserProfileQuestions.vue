<script setup>
import TextTemplate from '../TextTemplate.vue';
import Button from '../Button.vue';
import { ref } from 'vue';

const props = defineProps({
    inGameGroup: Boolean,
    participantId: String,
    experimentState: Number,
});

const emit = defineEmits(['update:experimentState']);

// Answers
const age = ref(null);
const expertise = ref(null);
const education = ref(null);

// Send result and go to next
function next() {
    // TODO handle results

    // Launch fullscreen for browsers that support it
    launchFullScreen(document.documentElement);
    // Go to next part in the experiment
    emit('update:experimentState', 1);
}

function launchFullScreen(element) {
    if (element.requestFullScreen) {
        element.requestFullScreen();
    } else if (element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if (element.webkitRequestFullScreen) {
        element.webkitRequestFullScreen();
    }
}
</script>

<template>
    <TextTemplate>
        <h2>Questions before your task</h2>
        <p>
            <b>
                <span class="error">IMPORTANT NOTICE:</span> Please do not refresh your browser at any time during this
                experiment. Also, do
                not use the 'back' and 'forward' buttons in your browser. Both will completely reset what you have
                done, and therefore your actions will not be recorded.
            </b>
        </p>
        <p v-if="inGameGroup">
            You have been given the game task. Please answer the questions below and then press 'NEXT'. The game
            about steganography will then start.
        </p>
        <p v-else>
            You have been given the reading task. Please answer the questions below and then press 'NEXT'. The text
            about steganography will then be shown.
        </p>

        <div class="form">
            <!-- Question 1: Age-->
            <div class="form-item column">
                <h3>What is your age?</h3>
                <input id="age" v-model="age" type="text" />
            </div>

            <!-- Question 2: Main expertise -->
            <h3>In what field is your main expertise?</h3>
            <div class="form-item">
                <input type="radio" id="Humanities and social sciences" value="Humanities and social sciences"
                    v-model="expertise" />
                <label for="Humanities and social sciences">
                    Humanities and social sciences<br />
                    <div class="example">
                        (e.g. history, linguistics, philosophy, arts, religion, economics, geography, culture, politics,
                        psychology, sociology)
                    </div>
                </label>
            </div>
            <div class="form-item">
                <input type="radio" id="Natural sciences" value="Natural sciences" v-model="expertise" />
                <label for="Natural sciences">
                    Natural sciences<br />
                    <div class="example">
                        (e.g. biology, chemistry, earth sciences, physics, space sciences)
                    </div>
                </label>
            </div>
            <div class="form-item">
                <input type="radio" id="Formal sciences" value="Formal sciences" v-model="expertise" />
                <label for="Formal sciences">
                    Formal sciences<br />
                    <div class="example">
                        (e.g. computer sciences, logic, mathematics, systems science)
                    </div>
                </label>
            </div>
            <div class="form-item">
                <input type="radio" id=" Professions and applied sciences" value=" Professions and applied sciences"
                    v-model="expertise" />
                <label for="Professions and applied sciences">
                    Professions and applied sciences<br />
                    <div class="example">
                        (e.g. engineering and technology, medicine and health, environmental studies, journalism and
                        media, law, social work, transportation, education, business, architecture and design,
                        agriculture)
                    </div>
                </label>
            </div>

            <!-- Question 3: Education level -->
            <h3>What is your education level?</h3>
            <div class="form-item">
                <input type="radio" id="WO" value="WO" v-model="education" />
                <label for="WO">
                    University (WO)
                </label>
            </div>
            <div class="form-item">
                <input type="radio" id="HBO" value="HBO" v-model="education" />
                <label for="HBO">
                    University of Applied Sciences (HBO)
                </label>
            </div>
            <div class="form-item">
                <input type="radio" id="MBO" value="MBO" v-model="education" />
                <label for="MBO">
                    College (MBO)
                </label>
            </div>
        </div>

        <div v-if="inGameGroup" style="margin-top: var(--standard-padding);">
            <h2>Game tips:</h2>
            <ul>
                <li>Do not reload the page</li>
                <li>Click anywhere to go to the next frame</li>
                <li>Use your mouse to answer questions and perform actions</li>
            </ul>
        </div>

        <div class="button">
            <Button v-if="inGameGroup" text="Start game" :onClick="next" />
            <Button v-else text="Start learning" :onClick="next" />
        </div>

    </TextTemplate>

</template>

<style scoped>
.form {
    margin-top: var(--standard-padding);
}

.example {
    font-size: 0.7rem;
}

ul {
    margin-left: 20px;
}
</style>
