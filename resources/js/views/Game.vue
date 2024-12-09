<script setup>
import DialogBox from '../components/game/DialogBox.vue';
import { ref } from 'vue';
import nodes from '../../data/dialogue.json';

// Current gamenode
let node = ref(nodes[0]);

// Game states
let name = ref("Player");
let score = ref(0);

// Binary search the nodes array
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

// Find next node
function handleTextOnClick() {
    node.value = binarySearchById(node.value.next);
}

// Find node of choice
function handleQuestionOnClick(choice) {
    // Set name when asked for name
    if (node.value.id === 101) {
        name.value = choice.text;
    }
    // Go to next node
    node.value = binarySearchById(choice.destination_id);
}
</script>

<template>
    <!-- Type TEXT -->
    <div v-if="node.type === 'TEXT'">
        <DialogBox :node="node" :onClick="handleTextOnClick" :name="name" />
    </div>
    <!-- Type QUESTION -->
    <div v-if="node.type === 'QUESTION'">
        <DialogBox :node="node" :onClick="handleQuestionOnClick" :name="name" />
    </div>
</template>
