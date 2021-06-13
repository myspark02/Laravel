require('./bootstrap');

require('alpinejs');

// window.Vue = require('vue');

// const app = new Vue({
//     el : '#app', 
// });

import Vue from "vue";
// import FollowButton from './components/FollowButton.vue'

Vue.component('follow-button', require('./components/FollowButton.vue').default);
const app = new Vue({
    el:'#app',
})

// const app = new Vue({
//     render : h => h(FollowButton)
// }).$mount("#follow");


// const app = Vue.createApp({})

// app.component('follow-button', require('./components/FollowButton.vue').default);
// app.mount('#app');