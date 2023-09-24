/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import {createApp} from 'vue';


import Chat from './components/Chat.vue';
import MyMessage from "./components/MyMessage.vue";
import Message from "./components/Message.vue";

import Echo from 'laravel-echo';
// import VueChatScroll from 'vue-chat-scroll';
import EmojiPicker from 'vue3-emoji-picker'
import At from 'vue-at';

import Pusher from 'pusher-js';
window.Pusher = Pusher;



window.Echo = new Echo({
    broadcaster: 'pusher',
    key:'ABCDEFG',
    wsHost: window.location.hostname,
    wsPort: 6001,
    wssPort: 6001,
    forceTLS:true,
    disableStats: true,
    // disableStats: true,
    //  enabledTransports: ['ws'],
    enabledTransports: ['ws','wss'],
})

const app = createApp({

});

app.component('chat', Chat);
app.component('my-message', MyMessage);
app.component('message', Message);
// app.use(VueChatScroll);
app.component('Picker',EmojiPicker);
app.component('At',At);
app.mount('#app');


