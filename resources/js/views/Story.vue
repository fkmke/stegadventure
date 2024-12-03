<template>
    <DirectedGraph :nodes="nodes" :links="links" />
</template>

<script setup>
import DirectedGraph from '../components/graphs/DirectedGraph.vue';

import jsonStory from '../../data/dialogue.json';

// Function to convert JSON to graph format
function convertDataToGraph(data) {
    const nodes = [];
    const nodeSet = new Set(); // Keep track of all node IDs
    const links = [];

    // Add nodes to the array and to the nodeSet
    data.forEach(item => {
        const nodeId = item.id.toString();
        nodes.push({ id: nodeId, content: item.content, character: item.character });
        nodeSet.add(nodeId);
    });

    // Add links and check if target nodes exist
    data.forEach(item => {
        const sourceId = item.id.toString();

        // Check for "next" links
        if (item.next) {
            const targetId = item.next.toString();
            if (nodeSet.has(targetId)) {
                links.push({ source: sourceId, target: targetId });
            } else {
                console.warn(`Missing node: ${targetId} referenced from node: ${sourceId}`);
            }
        }

        // Check for "choices" links
        if (item.choices) {
            item.choices.forEach(choice => {
                const targetId = choice.destination_id.toString();
                if (nodeSet.has(targetId)) {
                    links.push({ source: sourceId, target: targetId });
                } else {
                    console.warn(`Missing node: ${targetId} referenced from node: ${sourceId}`);
                }
            });
        }
    });

    return { nodes, links };
}

// Convert JSON into nodes and links
const { nodes, links } = convertDataToGraph(jsonStory);
</script>
