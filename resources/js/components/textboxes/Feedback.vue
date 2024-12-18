<script setup>
import TextTemplate from '../TextTemplate.vue';
import Button from '../Button.vue';

const props = defineProps({
    experimentState: Number,
    participantId: String,
    testScore: Number,
    inGameGroup: Boolean,
});

const emit = defineEmits(['update:experimentState']);
function next() {
    emit('update:experimentState', 5);
}

function grade() {
    const score = props.testScore < 0 ? 0 : props.testScore;
    const grade = score / 54 * 9 + 1;
    return Math.round(grade * 100) / 100;
}
</script>

<template>
    <TextTemplate>
        <h2>Feedback</h2>
        <p>
            You scored {{ props.testScore }} out of 54 points on the test (which is similar to a {{ grade() }} on a
            Dutch exam scale from 1-10)!
        </p>

        <div v-if="inGameGroup">
            <h3>Do you have any improvements for the game?</h3>
            <textarea type="text" />
        </div>

        <div v-else>
            <h3>Do you have any improvements for the text you read?</h3>
            <textarea type="text" />
        </div>

        <div>
            <h3>Anything else that you would like to share?</h3>
            <textarea type="text" />
        </div>

        <div class="button">
            <Button text="Next" :onClick="next" />
        </div>
    </TextTemplate>
</template>

<style scoped>
p+div,
div+div {
    margin-top: var(--standard-padding);
}

h3+textarea {
    margin-top: 10px;
}

p {
    font-size: larger;
}
</style>
