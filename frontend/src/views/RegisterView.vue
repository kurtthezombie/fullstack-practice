<script setup>

import { ref } from 'vue'
import loginservice from '@/services/login-service';

const name = ref('');
const email = ref('');
const password = ref('');
const message = ref('');

const submitForm = async () => {
    const formData = {
        name: name.value,
        email: email.value,
        password: password.value
    };
    try {
        console.log('calling register')
        const response = await loginservice.register(formData);
        console.log('after register')
        if(response.status) {
            console.log('inside status true')
            name.value = '';
            email.value = '';
            password.value = '';
        }
        message.value = response.message;
    } catch (error) {
        console.log('Error message: ', error);
    }

}

</script>

<template>
    <div class="registration">
        <form @submit.prevent="submitForm">
            <h1>Registration</h1>
            <label for="">Name</label>
            <input type="text" v-model="name"> <br>
            <label for="">Email</label>
            <input type="email" v-model="email"> <br>
            <label for="">Password</label>
            <input type="password" v-model="password"> <br>
            <button type="submit">Register</button>
        </form>
        <h5>{{ message }}</h5>
    </div>

</template>
