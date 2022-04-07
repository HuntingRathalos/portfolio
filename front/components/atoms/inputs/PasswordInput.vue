<template>
  <v-text-field
    v-model="setPassword"
    :rules="[rules.required, rules.minCount8]"
    prepend-icon="mdi-lock"
    label="パスワード"
    type="password"
  />
</template>
<script>
export default {
  props: {
    password: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      rules: {
        required: (value) => !!value || '必須項目なので値を入力してください。',
        minCount8: (value) =>
          value.length >= 8 || 'パスワードは8文字以上で入力してください。'
      }
    }
  },
  computed: {
    setPassword: {
      get() {
        return this.password
      },
      set(newVal) {
        return this.$emit('update:password', newVal)
      }
    }
  }
}
</script>
