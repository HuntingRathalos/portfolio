<template>
  <v-text-field
    v-model="setName"
    :rules="[rules.required, rules.maxCount255]"
    prepend-icon="mdi-account-outline"
    label="名前"
    type="text"
  />
</template>
<script>
export default {
  props: {
    name: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      rules: {
        required: (value) => !!value || '必須項目なので値を入力してください。',
        maxCount255: (value) =>
          value.length <= 255 || '文字数をオーバーしています。'
      }
    }
  },
  computed: {
    setName: {
      get() {
        return this.name
      },
      set(newVal) {
        return this.$emit('update:name', newVal)
      }
    }
  }
}
</script>
