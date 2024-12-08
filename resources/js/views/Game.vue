<script setup>
import DialogBox from '../components/game/DialogBox.vue';
import { ref } from 'vue';
import nodes from '../../data/dialogue.json';

let node = ref(nodes[0]);

function binarySearchById(targetId) {
    let left = 0;
    let right = nodes.length - 1;

    while (left <= right) {
        const mid = Math.floor((left + right) / 2);
        const currentId = nodes[mid].id;

        if (currentId === targetId) {
            return nodes[mid];
        } else if (currentId < targetId) {
            left = mid + 1;
        } else {
            right = mid - 1;
        }
    }
    return null;
}

function handleTextOnClick() {
    node.value = binarySearchById(node.value.next);
}

function handleQuestionOnClick(choice) {
    console.log(choice)
    node.value = binarySearchById(choice.destination_id);
}

</script>

<template>
    <!-- Type TEXT -->
    <div v-if="node.type === 'TEXT'">
        <DialogBox :node="node" :onClick="handleTextOnClick" />
    </div>
    <!-- Type QUESTION -->
    <div v-if="node.type === 'QUESTION'">
        <DialogBox :node="node" :onClick="handleQuestionOnClick" />
    </div>
</template>
