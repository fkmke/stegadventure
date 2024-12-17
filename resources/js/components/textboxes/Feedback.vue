<script setup>
import TextTemplate from '../TextTemplate.vue';
import Button from '../Button.vue';

const props = defineProps({
    experimentState: Number,
    participantId: String,
    testScore: Number,
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
        <h2>Optional feedback</h2>
        <p>
            You scored {{ props.testScore }} out of 54 points on the test (which is similar to a {{ grade() }} on a
            Dutch exam scale from 1-10)!
        </p>
        <p>
            If you would like to help this research, please answer the questions below.
        </p>

        <div class="button">
            <Button text="Next" :onClick="next" />
        </div>
    </TextTemplate>
</template>
