<template>
    <div class="relative h-10 m-1">
        <div style="border-top:1px solid #e6e6e6;" class="grid grid-cols-6">
            <input type="text" v-model="message"
                    @keyup.enter="sendMessage()" placeholder="message here"
                    class="col-span-5 p-1 outline-none"/>
            <button @click="sendMessage()"
                    class="p-1 mt-1 text-white bg-gray-500 rounded place-self-end hover:bg-blue-700">
                    Send
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['room'],
    data() {
        return {
            message:'',
        }
    },
    methods: {
        sendMessage() {
            if(this.message=='') return;
            axios.post('/chat/room/' + this.room.id + '/message', {
                message: this.message
            })
            .then(response => {
                if(response.status == 201) {
                    this.message = '';
                    this.$emit('messagesent', response.data);
                    // alert('messagesent')
                }
            })
            .catch(error => {
                console.log(error);
            })
            // this.form.post('/chat/room/' + this.room.id + '/message', {
            //     preserveScroll: true,
            //     onSuccess: () => {
            //         this.form.reset('message');
            //         this.$emit('messagesent');
            //     },
            // })
        }
    }
}
</script>
