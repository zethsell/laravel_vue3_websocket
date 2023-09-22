<template>
  <div class="container-message-wrapper">
    <div class="container-message">
      <div v-for="(message,index) in props.messages" :key="index">
        <message-item :message="message"/>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
import MessageItem from "@/pages/chat/messageItem.vue";

const props = defineProps(['messages'])


</script>
<style lang="scss" scoped>
.container-message-wrapper {
  width: 100vw;
}

.container-message {
  padding: 20px;
  display: flex;
  flex-direction: column-reverse;
  overflow: scroll;
}

</style>