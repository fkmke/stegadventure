<script setup>
import { ref } from 'vue';
import StudyInformation from '../components/textboxes/StudyInformation.vue';
import ConsentForm from '../components/textboxes/ConsentForm.vue';

const readStudyInformation = ref(false);
const hasGivenConsent = ref(false);

</script>

<template>
    <StudyInformation v-if="!readStudyInformation" v-model:readStudyInformation="readStudyInformation" />
    <ConsentForm v-if="readStudyInformation && !hasGivenConsent" v-model:readStudyInformation="readStudyInformation"
        v-model:hasGivenConsent="hasGivenConsent" />
</template>
