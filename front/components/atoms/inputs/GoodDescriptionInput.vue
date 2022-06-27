<template>
  <v-textarea
    v-model="setGoodDescription"
    counter="45"
    prepend-icon="mdi-emoticon-happy-outline"
    :rules="[rules.required, rules.maxCount45]"
    color="green accent-3"
    label="良かったポイント"
    rows="2"
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
        required: (value) => !!value || '必須項目なので値を入力してください。',
        maxCount45: (value) =>
          value.length <= 45 || '文字数をオーバーしています。'
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
