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
                            <button  @click="open_update_modal"
                                class="p-3 mr-4 text-white bg-blue-500 hover:bg-blue-400" required>수정</button>
                            <button @click="delete_class"
                                class="p-3 mr-4 text-white bg-red-400 hover:bg-red-600" required>삭제</button>

                            <button @click="register_class" v-if="registeredClass==false"
                                class="p-3 mr-4 text-black bg-green-400 hover:bg-green-300" required>수강신청</button>
                            <button  @click="unregister_class" v-if="registeredClass"
                                class="p-3 text-black bg-yellow-400 hover:bg-yellow-600" required>수강취소</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <jet-dialog-modal :show="confirmUpdate" @close="confirmUpdate = false">
            <template #title>
                교과목 수정
            </template>

            <template #content>
                <div class="mb-4">
                    <label class="text-xl text-gray-600">교과목명 </label>
                    <input type="text" class="w-full p-2 border-2 border-gray-300" v-model="form.name">
                    <div v-if="errors.name"><span class="text-red-500">{{ errors.name }}</span></div>
                </div>

                <div class="mb-4">
                    <label class="text-xl text-gray-600">학점</label>
                    <input type="number" class="w-full p-2 border-2 border-gray-300" v-model="form.credit">
                    <div v-if="errors.credit"><span class="text-red-500">{{ errors.credit }}</span></div>
                </div>

                <div class="mb-8">
                    <label class="text-xl text-gray-600">교과목 설명 <span class="text-red-500">*</span></label>
                    <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                    <div v-if="errors.description"><span class="text-red-500">{{ errors.description }}</span></div>
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click.native="confirmUpdate = false">
                    Cancel
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="update_class" >
                    Update
                </jet-danger-button>
            </template>
        </jet-dialog-modal>
    </app-layout>
</template>


<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetDialogModal from  '@/Jetstream/DialogModal.vue'
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default defineComponent({
        props : {'subject':Object, 'errors':Object, 'registeredClass' : Boolean},
        components: {
            AppLayout,
            JetDialogModal,
        },
        data() {
            return {
                editor: ClassicEditor,
                editorConfig: { autoGrow_minHeight : 300},
                form : {
                        name:null,
                        credit: 3,
                        description: '교과목 설명',
                },
                confirmUpdate : false, 
            }
        },
        methods : {
            open_update_modal() {
                this.form.name = this.subject.name;
                this.form.credit = this.subject.credit;
                this.form.description = this.subject.description;

                this.confirmUpdate = true;
            }, 

            update_class() {
                this.$inertia.patch('/classes/update/'+this.subject.id, this.form, {
                    onSuccess : () => {
                        this.form.name = '';
                        this.form.credit = '';
                        this.form.description = '';
                        this.confirmUpdate = false;
                    }, 
                });
            }, 

            delete_class() {
                this.$inertia.delete('/classes/delete/'+this.subject.id)
            },

            register_class() {
                this.$inertia.post('/classes/register/'+this.subject.id, 
                                        {}, 
                                        {
                                            only:['registeredClass'],
                                            preserveScroll : true,
                                        })
            }, 

            unregister_class() {
                this.register_class();
            }
        }, 
    }
)
</script>
