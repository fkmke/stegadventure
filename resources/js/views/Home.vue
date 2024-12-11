<script setup>
import { ref } from 'vue';
import StudyInformation from '../components/StudyInformation.vue';

const readStudyInformation = ref(false);

</script>

<template>
    <StudyInformation :readStudyInformation="readStudyInformation" />
</template>
