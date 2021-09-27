<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ username }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <post-list />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import PostList from '@/Pages/Instagram/PostList.vue'

    export default defineComponent({
        props: {
            username: String,
        },
        components: {
            AppLayout,
            PostList,
        },
    })
</script>
