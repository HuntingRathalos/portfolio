<template>
  <v-textarea
    v-model="setBadDescription"
    counter="50"
    prepend-icon="mdi-emoticon-cry-outline"
    :rules="[rules.maxCount60]"
    color="green accent-3"
    label="悪かったポイント"
    rows="2"
  ></v-textarea>
</template>
<script>
export default {
  props: {
    badDescription: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      rules: {
        maxCount60: (value) =>
          value.length <= 60 || '文字数をオーバーしています。'
      }
    }
  },
  computed: {
    setBadDescription: {
      get() {
        return this.badDescription
      },
      set(newVal) {
        return this.$emit('update:badDescription', newVal)
      }
    }
  }
}
</script>
