<script setup>
import DialogBox from '../components/game/DialogBox.vue';
import { ref } from 'vue';
import nodes from '../../data/dialogue.json';

let node = ref(nodes[17]);

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

function handleTypeTextOnClick() {
    node.value = binarySearchById(node.value.next);
}

</script>

<template>
    <!-- Type TEXT -->
    <div v-if="node.type === 'TEXT'">
        <DialogBox :character="node.character" :content="node.content" :onClick="handleTypeTextOnClick" />
    </div>
    <!-- Type QUESTION -->
    <div v-if="node.type === 'QUESTION'">
    </div>
</template>
