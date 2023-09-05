<script setup>
import { ref } from 'vue'
const email = ref('')
const password = ref('')

const login = () => {
    const url = 'http://localhost:8000/login';
    const data = {
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
    <input type="text" v-model="email" placeholder="Email">
    <input type="password" v-model="password" placeholder="Password">
    <button @click="login">Login</button>
</template>