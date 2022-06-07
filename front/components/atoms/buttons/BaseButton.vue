<template>
  <v-btn
    :class="className"
    :type="type"
    :color="color"
    width="width"
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
    },
    width: {
      type: [String, Number],
      default: '100%'
    }
  }
}
</script>
