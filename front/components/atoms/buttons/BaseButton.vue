<template>
  <v-btn
    :class="className"
    :type="type"
    :color="color"
    width="100%"
    height="42px"
    rounded
  >
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
    color: {
      type: String,
      default: 'primary'
    },
    type: {
      type: String,
      default: 'submit'
    }
  }
}
</script>
