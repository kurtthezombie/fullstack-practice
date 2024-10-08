import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { LoadingPlugin } from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/css/index.css';

const app = createApp(App)

app.use(LoadingPlugin, {
    canCancel: true,           // Allows cancellation of the loader
    isFullPage: true,          // Makes the loader cover the full page
    color: "#58E246",          // Set the color of the loader
    height: 128,               // Set the height of the loader
    width: 128,                // Set the width of the loader
    loader: 'spinner',         // Specify the type of loader
    backgroundColor: "#454545",// Set the background color
    enforceFocus: true 
});
app.use(router)

app.mount('#app')
