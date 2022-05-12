<template>
  <v-avatar
    size="42"
    class="mr-2"
  >
    <img :src="image_src" alt="logo">
  </v-avatar>
</template>

<script>
export default {
  data() {
  return {
    image_src: require("@/assets/1523255528.png"),
  }
}
}
</script>
