<script setup>
import TextTemplate from '../TextTemplate.vue';
import Button from '../Button.vue';
import { ref } from 'vue';

const props = defineProps({
    hasGivenConsent: Boolean,
});

// Check form
const checked = ref([]);
const showError = ref(false);

// Go back
const emit = defineEmits(['update:readStudyInformation', 'update:hasGivenConsent']);
function back() {
    emit('update:readStudyInformation', false);
}

// Go to next page if everything is checked
function next() {
    if (checked.value.length !== 4) {
        showError.value = true;
        return;
    }
    showError.value = false;
    emit('update:hasGivenConsent', true);
}
</script>

<template>
    <TextTemplate>
        <h2>Consent Form</h2>

        <div class="form">

            <h3>Taking part in the study</h3>
            <div class="form-item">
                <label for="1">
                    I have read and understood the study information, or it has been read to me. I have been able to ask
                    questions about the study and my questions have been answered to my satisfaction.
                </label>
                <input type="checkbox" id="1" value="1" v-model="checked" />
            </div>

            <div class="form-item">
                <label for="2">
                    I consent voluntarily to be a participant in this study and understand that I can refuse to answer
                    questions and I can withdraw from the study at any time, without having to give a reason.
                </label>
                <input type="checkbox" id="2" value="2" v-model="checked" />
            </div>

            <div class="form-item">
                <label for="3">
                    I understand that taking part in the study involves learning about steganography by either reading a
                    text, or by playing a game, and then answering questions in a survey about the engagement I had with
                    the task and answering test questions to test the learning effectiveness of the tool I used.
                </label>
                <input type="checkbox" id="3" value="3" v-model="checked" />
            </div>

            <h3>Use of the information in the study</h3>
            <div class="form-item">
                <label for="4">
                    I understand that information I provide will be used for analysing the learning effectiveness
                    differences and similarities, and analysing the engagement differences and similarities of the two
                    learning methods used (playing game or reading). Other possible relations in the data gathered may
                    also be analysed. The results of this study may be visualised and put into a report that will be
                    published online. Everyone can access that report. All data is completely anonymous.
                </label>
                <input type="checkbox" id="4" value="4" v-model="checked" />
            </div>
        </div>

        <p class="error" v-if="showError">
            * You must agree to all parts in the consent form in order to participate in the study. If you have any
            questions, please <a class="error" href="mailto:f.g.j.weijsenfeld@student.utwente.nl">contact</a> the
            researcher.
        </p>

        <div class="buttons">
            <Button text="Back" :onClick="back" :type="2" />
            <Button text="Next" :onClick="next" :type="1" />
        </div>
    </TextTemplate>

</template>

<style scoped>
.form {
    display: flex;
    flex-direction: column;
}

.form-item {
    display: flex;
    justify-content: space-between;
    padding-right: var(--standard-padding);
    gap: var(--standard-padding);
    align-items: center;
}

.form-item+.form-item,
.form-item+h3 {
    margin-top: var(--standard-padding);
}

input[type='checkbox'] {
    -webkit-appearance: none;
    appearance: none;
    min-width: var(--standard-padding);
    min-height: var(--standard-padding);
    max-width: var(--standard-padding);
    max-height: var(--standard-padding);
    background: white;
    border-radius: var(--rounded-big);
    border: var(--border-width) solid var(--secondary);
    cursor: pointer;
    position: relative;
}

input[type='checkbox']:checked {
    background: var(--primary);
}

input[type='checkbox']:checked::after {
    content: '';
    position: absolute;
    top: 6px;
    left: 10px;
    width: 6px;
    height: 12px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.error {
    color: var(--error);
    margin-top: var(--standard-padding);
}

.buttons {
    margin-top: var(--standard-padding);
    display: flex;
    justify-content: space-between;
}
</style>
