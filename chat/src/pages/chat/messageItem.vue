<template>
  <div>
    {{ props.message.user.name }}: {{ message.message }}
  </div>
</template>
<script setup lang="ts">
const props = defineProps(['message'])
</script>