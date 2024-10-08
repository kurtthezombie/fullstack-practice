<script setup>
import axios from 'axios'
import { onMounted, ref, inject } from 'vue'
import loginservice from '@/services/login-service';
import { useLoading } from 'vue-loading-overlay';

const name = ref('');
const email = ref('');
const password = ref('');
const message = ref('');
const captcha = ref('')
const captchaImage = ref('');
const captchaMessage = ref('');
const captchaKey = ref('');
const errors = ref({});

const $loading = useLoading();
const fullPage = ref(false);

const submitForm = async () => {
    console.log('Name: ', name.value)
    console.log('Email: ', email.value)
    console.log('Password: ', password.value)
    console.log('Captcha: ', captcha.value)
    const formData = {
        name: name.value,
        email: email.value,
        password: password.value,
        captcha: captcha.value,
        key: captchaKey.value
    };
    const loader = $loading.show();
    try {
        errors.value = {};
        const response = await axios.post('http://127.0.0.1:8000/api/post', formData)

        console.log(response.data.message)
        message.value = response.data.message;
        if (response.data.status){
            name.value = '';
            email.value = '';
            password.value = '';
            captcha.value = '';
        }
        
    } catch (error) {
        console.log('Aguy ni error');
        if (error.response && error.response.status === 422) {
            console.log(error.response.data);
            errors.value = error.response.data.errors;
        }
    } finally {
        loader.hide();
    }
    
    /*try {
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
    }*/
}

const handleReload = async() => {
    console.log('Button clicked');
    await axios.get('http://127.0.0.1:8000/captcha/api/math')
        .then(response => {
            console.log(response.data)
            captchaImage.value = response.data.img;
            captchaMessage.value = response.data.message;
            captchaKey.value = response.data.key;
        })
        .catch(error => {
            console.log('Error reloading CAPTCHA', error);
        });
}

onMounted(() => {
    errors.value = {}
    handleReload();
})

</script>

<template>
    <div class="registration">
        <form @submit.prevent="submitForm">
            <h1>Registration</h1>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" v-model="name"> <br>
                <span v-if="errors.name" style="color:red">{{ errors.name[0] }}</span>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" v-model="email"> <br>
                <span v-if="errors.email" style="color:red">{{ errors.email[0]}}</span>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" v-model="password"> <br>
                <span v-if="errors.password" style="color:red">{{ errors.password[0] }}</span>
            </div>
            <div class="captcha">
                <span>
                    <img :src="captchaImage" alt="">
                </span>
                <button type="button" id="reload" @click="handleReload">
                    &#x21bb;
                </button>
                <br>
                <span v-if="errors.captcha" style="color:red">{{  errors.captcha[0] }}</span>
                <div class="captcha-input">
                    <input type="text" placeholder="Enter Captcha" v-model="captcha">
                    <p>{{ message }}</p>
                </div>
            </div>

            <button type="submit">Register</button>
        </form>
        <h5>{{ message }}</h5>
        <!--<ul>
            <li style="color: red;" v-for="error in errors">{{ error }}</li>
        </ul>-->
    </div>

</template>
