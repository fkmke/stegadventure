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
    </div>
</template>

<style scoped></style>
