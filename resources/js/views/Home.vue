<script setup>
import { ref, watch, nextTick } from 'vue';
import { scrollToTop } from '../components/scrollToTop';
// Views
import StudyInformation from '../components/textboxes/StudyInformation.vue';
import ConsentForm from '../components/textboxes/ConsentForm.vue';

const readStudyInformation = ref(false);
const hasGivenConsent = ref(false);

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
</template>
