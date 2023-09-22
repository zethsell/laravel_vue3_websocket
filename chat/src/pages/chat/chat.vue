<template>
  <header>
    <h2>
      <chat-room-selection
          v-if="currentRoom?.id"
          :rooms="chatRooms"
          :currentRoom="currentRoom"
          @roomchanged="setRoom($event)"
      />
    </h2>
  </header>


  <div>
    <message-container :messages="messages"/>
    <input-message :room="currentRoom" @messagesent="getMessages()"/>
  </div>
</template>
<script setup lang="ts">
import MessageContainer from "@/pages/chat/messageContainer.vue";
import InputMessage from "@/pages/chat/inputMessage.vue";
import axios from "axios";
import {onMounted, ref, watch} from "vue";
import ChatRoomSelection from "@/pages/chat/chatRoomSelection.vue";
import _ from 'lodash';
import Pusher from "pusher-js";
import Echo from "laravel-echo";

const chatRooms = ref([])
const currentRoom = ref([])
const messages = ref([])
window._ = _;

const getRooms = () => {
  axios.get('api/rooms', {headers: {"Authorization": "Bearer 1|9wvadHHAw5zVAGAxKANbnCLKqwTpFlPsXkcZBwbx290b507e"}})
      .then((response) => {
        chatRooms.value = response.data.rooms
        setRoom(response.data.rooms[0])
      })
      .catch(err => {
        console.error(err)
      })
}

const setRoom = (room: any) => {
  currentRoom.value = room
  getMessages()
}

const getMessages = () => {
  axios.get(`api/messages/${currentRoom.value.id}`, {headers: {"Authorization": "Bearer 1|9wvadHHAw5zVAGAxKANbnCLKqwTpFlPsXkcZBwbx290b507e"}})
      .then((response) => {
        messages.value = response.data.messages
      })
      .catch(err => {
        console.error(err)
      })
}

watch(() => currentRoom.value, () => connect())

// app_id = "1675066"
// key = "c454f507bf4f49df23bb"
// secret = "477482e91a40a5da5b19"
// cluster = "us2"
const connect = () => {
  if (currentRoom.value.id) {
    let vm = this


    window.Pusher = Pusher;

    window.Echo = new Echo({
      authEndpoint: 'http://localhost:8000/broadcasting/auth',
      broadcaster: 'pusher',
      // key: 'c454f507bf4f49df23bb',//<-- para pusher
      // cluster: 'us2',//<-- para pusher
      // secret: '477482e91a40a5da5b19',//<-- para pusher
      // app_id: "1675066",//<-- para pusher
      encrypted: true,
      auth: {
        headers: {
          Authorization: 'Bearer 1|9wvadHHAw5zVAGAxKANbnCLKqwTpFlPsXkcZBwbx290b507e'
        },
      },
      wsHost: '127.0.0.1', //<-- para laravel websocket
      key: 'local', //<-- para laravel websocket
      app_id: 'local', //<-- para laravel websocket
      secret: 'local', //<-- para laravel websocket
      cluster: 'mt1', //<-- para laravel websocket
      wsPort: 6001,//<-- para laravel websocket
      // wssPort: 443,//<-- para pusher
      forceTLS: false,
      disableStats: true,
      // enabledTransports: ['ws', 'wss'],//<-- para pusher
    });

    window.Echo.private('chat.' + currentRoom.value.id)
        .listen('NewChatMessage', (e) => {
          console.log('here');
          getMessages()
        })
  }
}


onMounted(() => {
  getRooms()
  connect()

  // const connection = new WebSocket("wss://127.0.0.1:6001")
  //
  // connection.onmessage = function (event) {
  //   console.log(event)
  // }
  //
  // connection.onopen = function (event) {
  //   console.log(event)
  //   console.log("connected to web socket")
  // }

})
</script>