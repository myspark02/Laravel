<template>
  <div>
    <div class="mt-5 overflow-hidden rounded shadow-lg">
        <a  @click="imgClicked()"> <img class="w-full" :src="'/storage/' + post.image"  :alt="post.image"> </a>
    </div>

    <jet-dialog-modal :show="showPost" @close="showPost = false">
        <template #header></template>
        <template #content>
            <div class="w-full mx-3 overflow-hidden bg-white border rounded md:w-12/12 md:mx-0 lg:mx-0">
                <div class="flex justify-between w-full p-3">

                    <span class="px-2 rounded cursor-pointer hover:bg-gray-300"><i class="pt-2 text-lg fas fa-ellipsis-h"></i></span>
                    </div>
                        <img class="w-full bg-cover" :src="'/storage/' + post.image" alt="photo"/>
                    <div class="px-3 pb-2">
                    <div class="mt-2">
                        <span>{{post.caption}} </span>
                    </div>
                    <div class="pt-2">
                        <i class="cursor-pointer far fa-heart"></i>
                        <span class="text-sm font-medium text-gray-400">12 likes</span>
                    </div>
                    <div class="pt-1">
                        <div class="mb-2 text-sm">
                        <span class="mr-2 font-medium">braydoncoyer</span> Lord of the Rings is my favorite film-series. One day I'll make my way to New Zealand to visit the Hobbiton set!
                        </div>
                    </div>
                    <div class="mb-2 text-sm font-medium text-gray-400 cursor-pointer">View all 14 comments</div>
                        <div class="mb-2">
                            <div class="mb-2 text-sm">
                            <span class="mr-2 font-medium">razzle_dazzle</span> Dude! How cool! I went to New Zealand last summer and had a blast taking the tour! So much to see! Make sure you bring a good camera when you go!
                            </div>
                        </div>
                    </div>
            </div>
        </template>
        <template #footer>
             <div class="flex flex-row px-6 py-4">
                <button class="pr-4">
                <svg aria-label="좋아요" class="_8-yf5 " color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 48 48" width="24"><path d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path></svg>
                </button>
                <button class="pr-4">
                <svg aria-label="댓글 달기" class="_8-yf5 " color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 48 48" width="24"><path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">#photography</span>
                <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">#travel</span>
                <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">#winter</span>
            </div>
        </template>

    </jet-dialog-modal>

  </div>
</template>

<script>

import JetDialogModal from '@/Jetstream/ConfirmationModal.vue';

export default {
  props : ['post'],
  data() {
    return {
        showPost : false,
    }
  },
  methods: {
    imgClicked() {
        this.showPost = true;
    }
  },
  components  : {
      JetDialogModal,
  },

}
</script>
