<template>
    <app-layout title="교과목 등록">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                교과목 상세보기
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div class="mb-4">
                            <label class="text-xl text-gray-600">교과목명 </label>
                            <div  class="w-full p-2 border-2 border-gray-300">{{subject.name}}</div>
                        </div>

                        <div class="mb-4">
                            <label class="text-xl text-gray-600">학점</label>
                            <div  class="w-full p-2 border-2 border-gray-300">{{ subject.credit }}</div>
                        </div>

                        <div class="mb-8">
                            <label class="text-xl text-gray-600">교과목 설명 </label>
                            <div  class="w-full p-2 border-2 border-gray-300" v-html="subject.description"></div>
                        </div>
                        <div class="mb-8">
                            <label class="text-xl text-gray-600">등록일 </label>
                            <div  class="w-full p-2 border-2 border-gray-300">{{subject.created_at}}</div>
                        </div>
                        <div class="mb-8">
                            <label class="text-xl text-gray-600">변경일</label>
                            <div  class="w-full p-2 border-2 border-gray-300">{{subject.updated_at}}</div>
                        </div>                                                

                        <div class="flex p-1 mb-8">
                            <button class="p-3 mr-4 text-white bg-blue-500 hover:bg-blue-400" required>수정</button>
                            <button class="p-3 mr-4 text-white bg-red-400 hover:bg-red-600" required>삭제</button>

                            <button class="p-3 mr-4 text-black bg-green-400 hover:bg-green-300" required>수강신청</button>
                            <button class="p-3 text-black bg-yellow-400 hover:bg-yellow-600" required>수강취소</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>


<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'

    export default defineComponent({
        props : ['subject'],
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
