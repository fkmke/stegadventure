<script setup>
import { ref, watch, nextTick } from 'vue';
import { scrollToTop } from '../components/scrollToTop';
import { uuid } from "vue-uuid";
// Views
import StudyInformation from '../components/textboxes/StudyInformation.vue';
import ConsentForm from '../components/textboxes/ConsentForm.vue';
import UserProfileQuestions from '../components/textboxes/UserProfileQuestions.vue';
import Game from './Game.vue';
import SteganographyText from './SteganographyText.vue';

// Information and consent
const readStudyInformation = ref(false);
const hasGivenConsent = ref(false);

// Experiment
/*
State 0: information letter and consent
State 1: pre-experiment questions
State 2: performing the task
State 3: filling in UES-SF
State 4: performing the knowledge test
State 5: optional feedback
State 6: thank you for participating
*/
const experimentState = ref(0);

// Participant id
const participantId = uuid.v4();
const inGameGroup = Boolean(Math.floor(Math.random() * 2));

// Scroll to top when changing between pages
watch([readStudyInformation, hasGivenConsent], async (newValues, oldValues) => {
    await nextTick();
    scrollToTop();
});

</script>

<template>
    <!-- Information and consent -->
    <StudyInformation v-if="!readStudyInformation" v-model:readStudyInformation="readStudyInformation" />
    <ConsentForm v-if="readStudyInformation && !hasGivenConsent" v-model:readStudyInformation="readStudyInformation"
        v-model:hasGivenConsent="hasGivenConsent" />
    <!-- Experiment -->
    <div v-if="readStudyInformation && hasGivenConsent">
        <UserProfileQuestions v-if="experimentState === 0" :in-game-group="inGameGroup"
            v-model:experimentState="experimentState" />
        <div v-if="experimentState === 1">
            <Game v-if="inGameGroup" v-model:experimentState="experimentState" />
            <SteganographyText v-else v-model:experimentState="experimentState" />
        </div>
        <!-- TODO state 2-6 -->
    </div>
</template>

<style scoped></style>
