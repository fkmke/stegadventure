<script setup>
import TextTemplate from '../TextTemplate.vue';
import Button from '../Button.vue';

const props = defineProps({
    readStudyInformation: Boolean,
});

// Go to consent form
const emit = defineEmits(['update:readStudyInformation']);
function next() {
    emit('update:readStudyInformation', true);
}
</script>

<template>
    <TextTemplate>
        <h2>Study Information</h2>
        <h3>Purpose of the research</h3>
        <p>
            In this research, you will be learning about steganography, either by reading a text, or by playing a game.
            After this, you will be asked questions about to what extent you felt engaged during the task you performed.
            At last, you will be asked to answer some test questions to research the learning effectiveness of the
            method you used. All of this will take place online.
        </p>

        <h3>Benefits and risks</h3>
        <p>
            This research project has been reviewed by the Ethics Committee. The benefits are that you will learn about
            steganography. There are no risks involved in participating in this study.
        </p>

        <h3>Withdrawal from study</h3>
        <p>
            You may withdraw from this study at any time, without giving a reason. You can withdraw from the study by
            simply not completing all steps of the study in the online environment used.
        </p>

        <h3>Data gathered</h3>
        <p>
            All data collected will be completely anonymous and it will not be possible to identify a certain individual
            from the data. Therefore, after completing the tasks, it will not be possible to delete your data, since you
            cannot be identified.
        </p>
        <p>
            The data collected will be your answers from the questions asked in the survey and the time you spend per
            action
            taken. This information will only be accessible by the researcher, and only presented together with other
            data
            gathered during this study.
        </p>
        <p>
            All data collected will be deleted before December 31, 2025.
        </p>

        <h3>Contact information</h3>
        <p>
            Researcher: Femke Weijsenfeld
            (<a href="mailto:f.g.j.weijsenfeld@student.utwente.nl">f.g.j.weijsenfeld@student.utwente.nl</a>)
        </p>
        <p>
            If you have questions about your rights as a research participant, or wish to obtain information, ask
            questions, or discuss any concerns about this study with someone other than the researcher, please contact
            the Secretary of the Ethics Committee Information & Computer Science:
            <a href="mailto:ethicscommittee-cis@utwente.nl">ethicscommittee-cis@utwente.nl</a>.
        </p>

        <div class="button">
            <Button text="Next" :onClick="next" />
        </div>

    </TextTemplate>

</template>
