<template>
  <v-text-field
    v-model="setPasswordConfirmation"
    :rules="[rules.required, rules.minCount8]"
    prepend-icon="mdi-lock-check"
    label="パスワード確認用"
    type="password"
  />
</template>
<script>
export default {
  props: {
    passwordConfirmation: {
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
    setPasswordConfirmation: {
      get() {
        return this.passwordConfirmation
      },
      set(newVal) {
        return this.$emit('update:passwordConfirmation', newVal)
      }
    }
  }
}
</script>
