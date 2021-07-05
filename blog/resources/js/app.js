require('./bootstrap');

require('alpinejs');





window.Vue = require('vue').default


Vue.component('comment-list', require('./vue/CommentList.vue').default)

const app = new Vue({
    el : "#app",

})

// vm = Vue.createApp({})
// vm.component('comment-list', require('./vue/CommentList.vue').default);
// vm.mount('#app')
