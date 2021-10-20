<template>
<!-- component -->
<div class="flex flex-col justify-between flex-1 h-screen p:2 sm:p-6">
   <div id="messages" class="flex flex-col-reverse p-3 space-y-4 overflow-y-auto scrolling-touch scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2">
      <div v-if="messages" v-for="message in chatMessages.data" :key="message.id">
                <message-item :message="message" :loginUserId="loginUserId"/>
      </div>
   </div>

   <input-message :room="currentRoom"
         v-on:messagesent="newMessage()" />


   <div class="px-4 pt-4 mb-2 border-t-2 border-gray-200 sm:mb-0">
      <div class="relative flex">
         <span class="absolute inset-y-0 flex items-center">
            <button type="button" class="inline-flex items-center justify-center w-12 h-12 text-gray-500 transition duration-500 ease-in-out rounded-full hover:bg-gray-300 focus:outline-none">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-gray-600">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
               </svg>
            </button>
         </span>
         <input type="text" placeholder="Write Something" class="w-full py-3 pl-12 text-gray-600 placeholder-gray-600 bg-gray-200 rounded-full focus:outline-none focus:placeholder-gray-400">
         <div class="absolute inset-y-0 right-0 items-center hidden sm:flex">
            <button type="button" class="inline-flex items-center justify-center w-10 h-10 text-gray-500 transition duration-500 ease-in-out rounded-full hover:bg-gray-300 focus:outline-none">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-gray-600">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
               </svg>
            </button>
            <button type="button" class="inline-flex items-center justify-center w-10 h-10 text-gray-500 transition duration-500 ease-in-out rounded-full hover:bg-gray-300 focus:outline-none">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-gray-600">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
               </svg>
            </button>
            <button type="button" class="inline-flex items-center justify-center w-10 h-10 text-gray-500 transition duration-500 ease-in-out rounded-full hover:bg-gray-300 focus:outline-none">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-gray-600">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
               </svg>
            </button>
            <button type="button" class="inline-flex items-center justify-center w-12 h-12 text-white transition duration-500 ease-in-out bg-blue-500 rounded-full hover:bg-blue-400 focus:outline-none">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 transform rotate-90">
                  <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
               </svg>
            </button>
         </div>
      </div>
   </div>
</div>




</template>

<script>

// const el = document.getElementById('messages')
// el.scrollTop = el.scrollHeight

import MessageItem from "./messageItem.vue";
import InputMessage from './inputMessage.vue'

export default {
    components: {
      MessageItem,
      InputMessage,
    },

    props : ['messages', 'loginUserId', 'currentRoom'],

    data() {
        return {
           chatMessages : this.messages,
        }
    },

    methods: {
       getMessages(page) {
            let pageUrl = this.chatMessages.next_page_url;
            if (page != null) {
               pageUrl = page;
            }
            // alert(pageUrl);
            axios.get(pageUrl)
                .then(response=> {
                  //   console.log(response.data.length);
                    this.chatMessages = {
                       ...response.data,
                       data: [...this.chatMessages.data, ...response.data.data]
                    }
                }).catch(error => {
                    console.log(error);
            })
       },

       newMessage() {
         this.chatMessages.data = []
         this.getMessages(this.chatMessages.first_page_url);
       }
    },
    mounted () {
      document.documentElement.scrollTop = window.innerHeight-100;
      window.addEventListener('scroll', debounce((e) => {
         // let pixelsFomBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight;
         // console.log(pixelsFomBottom);
         // if (pixelsFomBottom < 200) {
         //   this.getMessages()
         // }
         if (document.documentElement.scrollTop < 20) {
            this.getMessages();
         }
      }, 100))
    },
    created() {


      // alert('messages_data length: ' + this.messages_data.length);
    }


}
</script>


