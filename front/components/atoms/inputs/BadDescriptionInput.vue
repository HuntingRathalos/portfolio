<template>
  <v-textarea
    v-model="setBadDescription"
    counter="45"
    prepend-icon="mdi-emoticon-cry-outline"
    :rules="[rules.required, rules.maxCount45]"
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
        required: (value) => !!value || '必須項目なので値を入力してください。',
        maxCount45: (value) =>
          value.length <= 45 || '文字数をオーバーしています。'
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
