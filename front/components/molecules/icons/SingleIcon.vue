<template>
  <v-card :class="marginClass">
    <v-icon @click="$emit('closeIconModal', false, iconCode)">
      {{ iconCode.code }}
    </v-icon>
  </v-card>
</template>
<script>
export default {
  props: {
    iconCode: {
      type: Object,
      default: () => ({})
    },
    marginClass: {
      type: String,
      default: 'mb-0'
    }
  }
}
</script>
