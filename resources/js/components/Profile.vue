<script setup>
import { ref, onMounted } from 'vue';
import update from '../api/user/update';
import profile from '../api/user/profile';

const nickname = ref('');
const username = ref('');
let email = ref('');
let balance = ref(0);
let password = ref('');
let currentPassword = ref('');
let passwordConfirmation = ref('');

profile().then((response) => {
    nickname.value = response.nickname;
    username.value = response.username;
    email.value = response.email;
    balance.value = response.balance;
});


const updateProfile = () => {
    update({
        nickname: nickname.value,
        username: username.value,
        password: password.value,
        current_password: currentPassword.value,
        password_confirmation: passwordConfirmation.value,
    }).then((response) => {
        console.log(response);
    });
};


</script>

<template>
    <input type="text" v-model="nickname" />
    <input type="text" v-model="username" />
    <input type="text" :value="email" />
    <input type="text" :value="balance" />
    <input type="text" v-model="currentPassword" placeholder="current password" />
    <input type="text" v-model="password" placeholder="new password" />
    <input type="text" v-model="passwordConfirmation" placeholder="password confirmation" />
    <button @click="updateProfile">Update</button>
</template>