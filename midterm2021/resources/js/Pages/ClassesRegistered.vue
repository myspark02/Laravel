<template>
    <app-layout title="교과목 등록">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                수강 교과목 리스트
            </h2>
            <h3>
                수강과목 수 : {{ numOfRegisteredClasses }}
            </h3>
            <h3>
                수강학점 : {{ totalCredits }}
            </h3>
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
                                            과목명
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            학점
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            수강신청자 수
                                        </th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="subject in subjects" :key="subject.id">
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap"> 
                                                <Link :href="'/classes/show/'+subject.id"> {{ subject.name }} </Link>
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ subject.credit }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <Link :href="'/classes/users/'+ subject.id" method="get" type="button">  
                                                    {{subject.users.length}} 
                                                </Link>
                                            </p>
                                        </td>                                     
                                    </tr>
                                </tbody>
                            </table>
                            <!-- <div
                                class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                                <pagination class="mt-6" :links="subjects.links" />
                            </div> -->
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

    // import Pagination from '@/Components/Pagination'

    import { Link } from '@inertiajs/inertia-vue3'

    export default defineComponent({
        props:['subjects'],
        components: {
            AppLayout,
            // Pagination, 
            Link,
        },
        data() {
            return {

            }
        },
        methods : {

        }, 
        computed : {
            numOfRegisteredClasses() {
                return this.subjects.length;
            }, 

            totalCredits() {
                let sum = 0;
                for (let i = 0 ; i < this.subjects.length; i++) {
                    sum += parseInt(this.subjects[i].credit);
                }
                return sum;
            }
        }
    }
)
</script>
