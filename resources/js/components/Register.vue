<script setup>
import { ref } from 'vue'
const name = ref('')
const email = ref('')
const password = ref('')


const register = () => {
    const url = 'http://localhost:8000/register';
    const data = {
        name: name.value,
        email: email.value,
        password: password.value
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(response => response.json())
    .then(data => {
        console.log(data)
    })
}


</script>

<template>
    <input type="text" v-model="name" placeholder="Name">
    <input type="text" v-model="email" placeholder="Email">
    <input type="password" v-model="password" placeholder="Password">
    <button @click="register">Register</button>
</template>