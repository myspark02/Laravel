<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                <chat-room-selection
                    v-if="currentRoom.id"
                    :rooms="chatRooms"
                    :currentRoom="currentRoom"
                    v-on:roomChanged="setRoom($event)"/>
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <advanced-message-container v-if="messages" :messages="messages" :loginUserId="loginUserId" :currentRoom="currentRoom" />

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'

    import ChatRoomSelection from './chatRoomSelection.vue'

    import AdvancedMessageContainer from './messageContainerV2.vue'

    export default defineComponent({
        props :['loginUserId'],
        components: {
            AppLayout,
            ChatRoomSelection,
            AdvancedMessageContainer
        },
        data() {
            return {
                chatRooms : [],
                currentRoom: {},
                messages : null,
            }
        },
        watch: {
            currentRoom(val, oldVal) {
                // alert(oldVal.id);
                // alert('watch:'+val.id)
                if (oldVal.id) {
                    this.disconnect(oldVal);
                }
                this.connect();
            }
        },
        methods : {
            connect() {

                if (this.currentRoom.id) {
                    // alert('connecto to room id : ' + this.myCurrentRoom.id);
                    let vm = this;
                    this.getMessages();
                    window.Echo.private('chat.' + this.currentRoom.id)
                                .listen('.message.new', e => {
                                    // vm.getMessages();
                                    // console.log('e:'+JSON.stringify(e));
                                    // console.log(e.chatMessage.message);
                                    // console.log(this.messages);

                                    // this.messages.data = [e.chatMessage, ...this.messages.data];
                                    let chatMessages = {...this.messages};
                                    chatMessages.data = [e.chatMessage, ...chatMessages.data];
                                    // this.messages = null;
                                    this.messages = {...chatMessages};
                                    // alert(this.messages == chatMessages)
                                    // console.log(JSON.stringify(this.messages.data))

                                })
                }
            },
            disconnect(room) {
                // alert('disconnect to room id : ' + room.id);
                window.Echo.leave('chat.' + room.id);
            },
            getRooms() {
                axios.get('/chat/rooms')
                .then(response=>{
                    this.chatRooms = response.data;
                    this.setRoom(response.data[0]);
                })
                .catch(error=> {
                    console.log(error);
                })
            },

            setRoom(room) {
                if (this.currentRoom != room) {
                    if (this.currentRoom.id) {
                        alert('disconnecting to ' + this.currentRoom.id)
                        this.disconnect(this.currentRoom);
                    }


                    this.currentRoom = room;
                    // alert('connecting to ' + this.currentRoom.id)
                    this.connect();
                }


            },

            getMessages() {
                axios.get('/chat/room/' + this.currentRoom.id + '/messages')
                .then(response=> {
                    this.messages = response.data;
                }).catch(error => {
                    console.log(error);
                })
            }
        },

        created() {
            this.getRooms();
        }

    })
</script>
