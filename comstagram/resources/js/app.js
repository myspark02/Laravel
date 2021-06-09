require('./bootstrap');

require('alpinejs');

window.Vue = require('vue');


Vue.component('follow-button', require('./components/FlollowButton.vue').default);

const app = new Vue({

});