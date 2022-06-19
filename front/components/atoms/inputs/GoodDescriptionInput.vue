<template>
  <v-textarea
    v-model="setGoodDescription"
    prepend-icon="mdi-emoticon-happy-outline"
    :rules="[rules.maxCount60]"
    color="green accent-3"
    label="良かったポイント"
    rows="3"
  ></v-textarea>
</template>
<script>
export default {
  props: {
    goodDescription: {
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
    setGoodDescription: {
      get() {
        return this.goodDescription
      },
      set(newVal) {
        return this.$emit('update:goodDescription', newVal)
      }
    }
  }
}
</script>
