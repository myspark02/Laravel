<template>
    <app-layout title="Home">
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <home-post-list :posts="posts"  :user="user" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import HomePostList from '@/Pages/Instagram/HomePostList.vue'
    // import {Link} from '@inertiajs/inertia-vue3'

    export default defineComponent({
        props : ['user', 'posts',],
        components: {
            AppLayout,
            HomePostList,
            // Link,
        },
        data() {
            return {

            }
        },
        methods: {

            },
    })
</script>
