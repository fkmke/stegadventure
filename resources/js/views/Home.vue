<script setup>
import { ref, watch, nextTick } from 'vue';
import { scrollToTop } from '../components/scrollToTop';
import { uuid } from "vue-uuid";
// Views
import StudyInformation from '../components/textboxes/StudyInformation.vue';
import ConsentForm from '../components/textboxes/ConsentForm.vue';
import UserProfileQuestions from '../components/textboxes/UserProfileQuestions.vue';

// Information and consent
const readStudyInformation = ref(false);
const hasGivenConsent = ref(false);

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
    <UserProfileQuestions v-if="readStudyInformation && hasGivenConsent" :in-game-group="inGameGroup" />
</template>
