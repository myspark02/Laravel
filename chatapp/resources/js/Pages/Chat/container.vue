<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <chat-room-selection
                    v-if="currentRoom.id"
                    :rooms="chatRooms"
                    :currentRoom="currentRoom"
                    v-on:roomChanged="setRoom($event)"/>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- <message-container :messages="messages" /> -->
                    <advanced-message-container :messages="messages" :loginUserId="loginUserId" />
                    <input-message :room="currentRoom"
                                    v-on:messagesent="getMessages()" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'

    import MessageContainer from './messageContainer.vue'
    import InputMessage from './inputMessage.vue'
    import ChatRoomSelection from './chatRoomSelection.vue'

    import AdvancedMessageContainer from './messageContainerV1.vue'

    export default defineComponent({
        props :['loginUserId', 'messages', 'chatRooms', 'currentRoom'], 
        components: {
            AppLayout,
            MessageContainer,
            InputMessage,
            ChatRoomSelection,
            AdvancedMessageContainer
        },
        data() {
            return {
                // chatRooms : [],
                myCurrentRoom: null,
                // messages : [],
            }
        },
        // watch: {
        //     currentRoom(val, oldVal) {
        //         // alert(oldVal.id);
        //         alert('watch:'+val.id)
        //         if (oldVal.id) {
        //             this.disconnect(oldVal);
        //         }
        //         this.connect();
        //     }
        // },
        methods : {
            connect() {
                if(this.myCurrentRoom == null) this.myCurrentRoom = this.currentRoom;
                if (this.myCurrentRoom.id) {
                    // alert('connecto to room id : ' + this.myCurrentRoom.id);
                    let vm = this;
                    // this.getMessages();
                    window.Echo.private('chat.' + this.myCurrentRoom.id)
                                .listen('.message.new', e => {
                                    vm.getMessages();
                                    // console.log(this.messages);
                                })
                }
            },
            disconnect(room) {
                // alert('disconnect to room id : ' + room.id);
                window.Echo.leave('chat.' + room.id);
            },
            // getRooms() {
            //     axios.get('/chat/rooms')
            //     .then(response=>{
            //         this.chatRooms = response.data;
            //         this.setRoom(response.data[0]);
            //     })
            //     .catch(error=> {
            //         console.log(error);
            //     })
            // },

            setRoom(room) {
                if (this.myCurrentRoom != room) {
                    if (this.myCurrentRoom != null) {
                        alert('disconnecting to ' + this.myCurrentRoom.id)
                        this.disconnect(this.myCurrentRoom);
                    }
                    

                    this.myCurrentRoom = room;
                    alert('connecting to ' + this.myCurrentRoom.id)                    
                    this.connect();
                }


            },

            getMessages() {
                // axios.get('/chat/room/' + this.currentRoom.id + '/messages')
                // .then(response=> {
                //     this.messages = response.data;
                // }).catch(error => {
                //     console.log(error);
                // })
                // alert('getMessages')
                this.$inertia.get('/chat/room/' + this.myCurrentRoom.id + '/messages', {}, 
                {preserveScroll:true, only:['messages']});
               
            }
        },

        created() {
            // this.getRooms();
            // this.messages = this.page_messages;
            // alert(this.loginUserId);
            // alert(this.chatRooms[0].name);
            // alert(this.currentRoom.id)
            // alert('created')
            // this.setRoom(this.currentRoom);
           
            // if (this.myCurrentRoom == null) this.myCurrentRoom = this.currentRoom;
            this.connect();
   
        }

    })
</script>
