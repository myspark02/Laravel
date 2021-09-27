<template>
  <div>
    <div class="mt-5 overflow-hidden rounded shadow-lg">
      <a  @click="imgClicked()"> <img class="w-full" src="/mountain.jpg" alt="Mountain"> </a>
      <div class="px-6 py-4">
        <div class="mb-2 text-xl font-bold">Mountain</div>
        <p class="text-base text-gray-700">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
        </p>
      </div>
      <div class="px-6 pt-4 pb-2">
        <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">#photography</span>
        <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">#travel</span>
        <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">#winter</span>
      </div>
    </div>

    <jet-confirmation-modal :show="confirmingUserDeletion" @close="confirmingUserDeletion = false">
        <template #title>
            Delete Account
        </template>

        <template #content>
            Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted.
        </template>

        <template #footer>
            <jet-secondary-button @click.native="confirmingUserDeletion = false">
                Nevermind
            </jet-secondary-button>

            <jet-danger-button class="ml-2" @click.native="deleteTeam" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Delete Account
            </jet-danger-button>
        </template>
    </jet-confirmation-modal>
  </div>
</template>

<script>
import JetConfirmationModal from '@/Jetstream/ConfirmationModal.vue';

export default {
  data() {
    return {
      confirmingUserDeletion : false,
    }
  },
  methods: {
    imgClicked() {
      alert('hi')
      this.confirmingUserDeletion = true;
    }
  }, 
  components  : {
    JetConfirmationModal
  }, 

}
</script>