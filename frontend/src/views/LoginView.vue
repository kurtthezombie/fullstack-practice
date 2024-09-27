<script setup>

import { ref } from 'vue';
import loginservice from '@/services/login-service';
import { useRouter } from 'vue-router';

const router = useRouter();
const name = ref('');
const password = ref('');
const message = ref('');

const submitForm = async () => {
    const formData = {
        name: name.value,
        password: password.value,
    }
    try {
        const response = await loginservice.login(formData);
        //do if logged in successfully
        name.value = '';
        password.value = '';
        message.value = response.message
        console.log(response)
        router.push({ name: 'dashboard' });
    } catch (error) {
        console.log('error daw: ',error);
    }
}

</script>

<template>
    <div class="login-form">
        <form @submit.prevent="submitForm">
            <h2>Login</h2>
            <label for="">Name</label> <br>
            <input type="name" v-model="name"> <br>
            <label for="">Password</label><br>
            <input type="password" v-model="password"> <br>
            <button type="submit">Login</button>
        </form>
        <h4>{{ message }}</h4>
    </div>
</template>

