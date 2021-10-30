<template>
    <app-layout title="교과목 등록">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                수강신청자 리스트 
            </h2>
        </template>
<!-- component -->
        <body class="antialiased font-sans bg-gray-200">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            사용자 프로파일 이미지 
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            사용자 명 
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            사용자 이메일
                                        </th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users.data" :key="user.id">
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ user.name }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ user.email }}
                                            </p>
                                        </td>                                        
                                    </tr>
                                </tbody>
                            </table>
                            <div
                                class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                                <pagination class="mt-6" :links="users.links" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </app-layout>
</template>


<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'

    import Pagination from '@/Components/Pagination'

    import { Link } from '@inertiajs/inertia-vue3'

    export default defineComponent({
        props:['users'],
        components: {
            AppLayout,
            Pagination, 
            Link,
        },
        data() {
            return {

            }
        },
        methods : {

        }
    }
)
</script>
