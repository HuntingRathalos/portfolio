<template>
  <v-card :class="marginClass">
    <v-icon @click="$emit('closeIconModal', false)">
      {{ iconCode }}
    </v-icon>
  </v-card>
</template>
<script>
export default {
  props: {
    iconCode: {
      type: String,
      required: true
    },
    marginClass: {
      type: String,
      default: 'mb-0'
    }
  }
}
</script>
