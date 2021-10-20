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
                    <!-- <advanced-message-container v-if="messages" :messages="messages" :loginUserId="loginUserId" :currentRoom="currentRoom" /> -->
                    <div class="flex flex-col justify-between flex-1 h-screen p:2 sm:p-6">
                        <div id="messages" class="flex flex-col-reverse p-3 space-y-4 overflow-y-auto scrolling-touch scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2">
                            <div v-if="messages" v-for="message in messages.data" :key="message.id">
                                        <message-item :message="message" :loginUserId="loginUserId"/>
                            </div>
                        </div>

                    </div>

                    <input-message :room="currentRoom"
                        v-on:messagesent="newMessage" />

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

    import MessageItem from "./messageItem.vue";
    import InputMessage from './inputMessage.vue'

    export default defineComponent({
        props :['loginUserId'],
        components: {
            AppLayout,
            ChatRoomSelection,
            AdvancedMessageContainer,
            MessageItem,
            InputMessage
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
                    this.getFirstMessages();
                    window.Echo.private('chat.' + this.currentRoom.id)
                                .listen('.message.new', e => {
                                    // vm.getMessages();
                                    // console.log('e:'+JSON.stringify(e));
                                    // console.log(e.chatMessage.message);
                                    // console.log(this.messages);

                                    // this.messages.data = [e.chatMessage, ...this.messages.data];
                                    // let chatMessages = {...this.messages};
                                    // chatMessages.data = [e.chatMessage, ...chatMessages.data];
                                    // this.messages = null;
                                    // alert('here')
                                    if(this.messages.data[0] && e.chatMessage.id == this.messages.data[0].id)
                                        return;  //duplicate one, I don't know why.
                                    this.messages = {...this.messages, 'data':[e.chatMessage, ...this.messages.data]};
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
                        // alert('disconnecting to ' + this.currentRoom.id)
                        this.disconnect(this.currentRoom);
                    }


                    this.currentRoom = room;
                    // alert('connecting to ' + this.currentRoom.id)
                    this.connect();
                }


            },

            getFirstMessages() {
                // alert('getFirstMessage')
                axios.get('/chat/room/' + this.currentRoom.id + '/messages')
                .then(response=> {
                    this.messages = response.data;
                    // echo('getFirstMessage:' + this.messages.data.length)
                }).catch(error => {
                    console.log(error);
                })
            },


            getMoreMessages(page) {
                if (this.messages == null) return;
                let pageUrl = this.messages.next_page_url;
                if (page != null) {
                    pageUrl = page;
                }
                alert(pageUrl);
                axios.get(pageUrl)
                    .then(response=> {
                    //   console.log(response.data.length);
                        this.messages = {
                        ...response.data,
                        data: [...this.messages.data, ...response.data.data]
                        }
                    }).catch(error => {
                        console.log(error);
                })
                },

                newMessage(e) {
                    // alert(JSON.stringify(e))
                    this.messages.data = [e, ...this.messages.data];
                    // this.getFirstMessages();
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
                this.getMoreMessages();
            }
            }, 100))
        },

        created() {
            this.getRooms();
        }

    })
</script>

<style>
.scrollbar-w-2::-webkit-scrollbar {
  width: 0.25rem;
  height: 0.25rem;
}

.scrollbar-track-blue-lighter::-webkit-scrollbar-track {
  --bg-opacity: 1;
  background-color: #f7fafc;
  background-color: rgba(247, 250, 252, var(--bg-opacity));
}

.scrollbar-thumb-blue::-webkit-scrollbar-thumb {
  --bg-opacity: 1;
  background-color: #edf2f7;
  background-color: rgba(237, 242, 247, var(--bg-opacity));
}

.scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
  border-radius: 0.25rem;
}
</style>
