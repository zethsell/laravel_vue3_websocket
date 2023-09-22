<template>
  <div>
    <div>
      {{ selected?.name }} Chat
    </div>
    <div>
      <select name="" id="" v-model="selected" @change="emits('roomchanged', selected)">
        <option v-for="(room, index) in rooms" :key="index" :value="room">
          {{ room?.name }}
        </option>
      </select>
    </div>
  </div>
</template>
<script lang="ts" setup>
import {onMounted, ref} from "vue";

const props = defineProps(['rooms', 'currentRoom'])
const emits = defineEmits(['roomchanged'])
const selected = ref('')

onMounted(() => {
  selected.value = props.currentRoom
})
</script>