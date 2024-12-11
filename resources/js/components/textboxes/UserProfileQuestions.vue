<script setup>
import TextTemplate from '../TextTemplate.vue';
import Button from '../Button.vue';

const props = defineProps({
    inGameGroup: Boolean,
});

</script>

<template>
    <TextTemplate>
        <h2>Questions before your task</h2>
        <div>
            <p>
                <b>
                    IMPORTANT NOTICE: Please do not refresh your browser at any time during this experiment. Also, do
                    not use the 'back' and 'forward' buttons in your browser. Both will completely reset what you have
                    done, and therefore your actions will not be recorded.
                </b>
            </p>
            <p v-if="inGameGroup">
                You have been given the game task. Please answer the questions below and then press 'NEXT'. The game
                will then start.
            </p>
            <p v-else>
                You have been given the reading task. Please answer the questions below and then press 'NEXT'. The text
                will then be shown.
            </p>
        </div>

    </TextTemplate>

</template>

<style scoped></style>
