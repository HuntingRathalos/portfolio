<template>
  <v-btn :class="className" :type="type">
    <slot></slot>
  </v-btn>
</template>
<script>
export default {
  props: {
    className: {
      type: String,
      default: 'info'
    },
    type: {
      type: String,
      default: 'submit'
    }
  }
}
</script>
