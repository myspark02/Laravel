require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import Vue from 'vue'

import GithubUserList from './vue/GithubUserList.vue'

const app = new Vue(
    {
        el: '#userlist',
        components : {GithubUserList},
    }
);
