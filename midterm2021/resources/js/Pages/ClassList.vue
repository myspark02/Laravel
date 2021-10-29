<template>
    <app-layout title="교과목 등록">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                교과목 리스트
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        교과목 리스트
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>


<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'

    export default defineComponent({
        components: {
            AppLayout,
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
