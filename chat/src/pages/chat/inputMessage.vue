<template>
  <div>
    <div>
      <input type="text" v-model="message" @keyup.enter="sendMessage()" placeholder="say something...">
      <button @click="sendMessage()">Send</button>
    </div>
  </div>
</template>
<script setup lang="ts">
import {ref} from "vue";
import axios from "axios";

const props = defineProps(['room'])
const emit = defineEmits(['messagesent'])
const message = ref('')

const sendMessage = () => {
  if (message.value == '') return

  axios.post(`api/new-message/${props.room.id}`, {
        message: message.value
      },
      {headers: {"Authorization": "Bearer 1|9wvadHHAw5zVAGAxKANbnCLKqwTpFlPsXkcZBwbx290b507e"}})
      .then((response) => {
        if ([201, 200].includes(response.status)) {
          message.value = ''
          emit('messagesent')
        }
      })
      .catch(err => {
        console.error(err)
      })
}
</script>
<style lang="scss" scoped>

</style>
