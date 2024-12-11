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
import UES from '../components/textboxes/UES.vue';
import KnowledgeTest from '../components/textboxes/KnowledgeTest.vue';
import Feedback from '../components/textboxes/Feedback.vue';
import ThankYou from '../components/textboxes/ThankYou.vue';

// Information and consent
const readStudyInformation = ref(false);
const hasGivenConsent = ref(false);

// Experiment
/*
State 0: information letter, consent, and pre-experiment questions
State 1: performing the task
State 2: filling in UES-SF
State 3: performing the knowledge test
State 4: optional feedback
State 5: thank you for participating
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
        <!-- State 0: pre-experiment questions -->
        <UserProfileQuestions v-if="experimentState === 0" :in-game-group="inGameGroup"
            v-model:experimentState="experimentState" :participantId="participantId" />

        <!-- State 1: performing the task -->
        <div v-if="experimentState === 1">
            <Game v-if="inGameGroup" v-model:experimentState="experimentState" :participantId="participantId" />
            <SteganographyText v-else v-model:experimentState="experimentState" :participantId="participantId" />
        </div>

        <!-- TODO state 2-6 -->
        <!-- State 2: filling in UES-SF -->
        <UES v-if="experimentState === 2" v-model:experimentState="experimentState" :participantId="participantId" />

        <!-- State 3: performing the knowledge test -->
        <KnowledgeTest v-if="experimentState === 3" v-model:experimentState="experimentState"
            :participantId="participantId" />

        <!-- State 4: optional feedback -->
        <Feedback v-if="experimentState === 4" v-model:experimentState="experimentState"
            :participantId="participantId" />

        <!-- State 5: thank you for participating -->
        <ThankYou v-if="experimentState === 5" />
    </div>
</template>

<style scoped></style>
