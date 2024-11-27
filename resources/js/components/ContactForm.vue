<script setup>
import { ref, inject } from "vue";

const nameRule = [(v) => !!v || "Name is required 🡅"];

const emailRule = [
    (v) => !!v || "E-mail is required 🡅",
    (v) =>
        /^(([^<>()[\]\\.,;:\s@']+(\.[^<>()\\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
            v
        ) || "E-mail must be valid 🡅",
];

const subjectRule = [(v) => !!v || "Subject is required 🡅"];

const messageRule = [
    (v) => !!v || "Message is required 🡅",
    (v) => (v && v.length > 5) || "Message must be longer than five characters 🡅",
];

const name = ref("");
const email = ref("");
const subject = ref("");
const message = ref("");

const isValidForm = ref(null);
const showForm = ref(true);
const loading = ref(false);

const axios = inject('axios');

function onSubmit() {
    if (isValidForm.value === true) {
        loading.value = true;
        // Send a POST to the api to send an email
        axios.post('/api/contactform', {
            name: name.value,
            email: email.value,
            subject: subject.value,
            message: message.value
        })
            .then(function (response) {
                console.log("Message has been sent.");
                showForm.value = false;
                loading.value = false;
            })
            .catch(function (error) {
                console.log(error);
                loading.value = false;
            });
    }
}

</script>

<template>
    <div>
        <v-sheet v-if="showForm">
            <v-form @submit.prevent="onSubmit" v-model="isValidForm">
                <v-text-field v-model="name" :rules="nameRule" label="Name" />
                <v-text-field v-model="email" :rules="emailRule" label="Email" />
                <v-text-field v-model="subject" :rules="subjectRule" label="Subject" />
                <v-textarea v-model="message" :rules="messageRule" label="Message" />
                <v-btn type="submit" :loading="loading" block>Submit</v-btn>
            </v-form>
        </v-sheet>
        <p v-else>
            Thank you for contacting us! We will get in contact with you as soon as possible.
        </p>
        <br>
    </div>

</template>

<style scoped></style>
