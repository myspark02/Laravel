<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="flex flex-col items-start md:flex-row">

                <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 px-40 mr-3" >
                    <img class="object-cover w-40 h-40 rounded-full" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                </div>
                <div class="flex-col mt-2 justify-items-start">
                    <div class="flex flex-row items-end justify-between">
                        <h2 class="mb-4 text-xl font-semibold leading-tight text-gray-800">
                        {{ user.name }}
                        </h2>
                        <!-- <Link :href="route('post.create')"> -->
                        <jet-secondary-button class="mb-4" @click="createNewPost=true">Add New Post</jet-secondary-button>
                        <jet-secondary-button class="mb-4" @click="editProfile=true">Edit Profile</jet-secondary-button>
                        <!-- </Link> -->
                    </div>
                    <div class="flex flex-row mb-4">
                        <div class="mr-10">게시시물  <span class="font-black">{{ posts.length }}</span></div>
                        <div class="mr-10">팔로워 <span class="font-black">80 </span></div>
                        <div class="mr-10"> 팔로우 <span class="font-black">72</span></div>
                    </div>
                    <div class="mb-4">{{ user.username }}</div>
                     <div class="mb-4">{{ user.profile? user.profile.title : 'No Title' }}</div>
                    <div class="mb-4">{{ user.profile? user.profile.description : 'No Description'}}</div>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <post-list :posts="posts" />
                </div>
            </div>
        </div>


    <jet-dialog-modal :show="createNewPost" @close="createNewPost = false">
        <template #title>
            Create New Post
        </template>

        <template #content>
            <form @submit.prevent="submit">
                <div>
                    <jet-label for="caption" value="caption" />
                    <jet-input id="caption" type="text" class="block w-full mt-1"
                        v-model="form.caption" required autofocus autocomplete="caption" />
                    <jet-input-error :message="form.errors.caption" class="mt-2" />
                </div>
                 <div>
                    <jet-label for="image" value="image" />
                    <!-- <jet-input id="image" type="file" class="block w-full mt-1"
                        @input="form.image=$event.target.files[0]" required autofocus autocomplete="caption" /> -->
                    <!-- Image File Input -->
                    <input type="file" class="hidden"
                            ref="image"
                            @change="updateImagePreview">
                                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" v-show="imagePreview">
                        <span class="block w-20 h-20 bg-center bg-no-repeat bg-cover rounded-full"
                            :style="'background-image: url(\'' + imagePreview + '\');'">
                        </span>
                    </div>

                    <jet-secondary-button class="mt-2 mr-2" type="button" @click.prevent="selectNewImage">
                        Select A New Image
                    </jet-secondary-button>

                    <jet-input-error :message="form.errors.image" class="mt-2" />
                     <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                </div>
            </form>
        </template>

        <template #footer>
            <jet-secondary-button @click.prevent="submit">
                Create
            </jet-secondary-button>

            <!-- <jet-danger-button class="ml-2" @click.native="deleteTeam" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Delete Account
            </jet-danger-button> -->
        </template>
    </jet-dialog-modal>

    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import PostList from '@/Pages/Instagram/PostList.vue'
    // import {Link} from '@inertiajs/inertia-vue3'

    import JetDialogModal from '@/Jetstream/ConfirmationModal.vue';
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'

    export default defineComponent({
        props : ['user', 'posts'],
        components: {
            AppLayout,
            PostList,
            // Link,
            JetDialogModal,
            JetSecondaryButton,
            JetInput,
            JetInputError,
            JetLabel
        },

        data() {
            return {
                form: this.$inertia.form({
                     _method: 'POST',
                    caption:'',
                    image : '',
                }),
                createNewPost : false,
                imagePreview: null,
                editProfile: false,
            }
        },

        methods: {
            submit() {
                if (this.$refs.image) {
                    this.form.image = this.$refs.image.files[0]
                }
                this.form.post(route('post.store'), {
                    errorBag: 'createNewPost',
                    preserveScroll: true,
                    onSuccess: () => {this.clearFields(); },
                });

            },

            clearFields() {
                this.createNewPost = false;
                this.form.caption = '';
                this.form.image = '';
            },

            updateImagePreview() {
                const photo = this.$refs.image.files[0];

                if (! photo) return;

                const reader = new FileReader();

                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };

                reader.readAsDataURL(photo);
            },

            selectNewImage() {
                this.$refs.image.click();
            },
        }
    })
</script>
