<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="flex flex-row items-start">
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col overflow-hidden text-center bg-white shadow-xl sm:rounded-lg ">
                   <div class="mb-4">
                        <span class="text-3xl font-black">죄송합니다. 페이지를 사용할 수 없습니다.</span>
                    </div>
                    <div>
                        <span>클릭하신 링크가 잘못되었거나 페이지가 삭제되었습니다. Instagram으로 돌아가기.</span>
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
        props : ['user'],
        components: {
            AppLayout,
        },
    })
</script>
