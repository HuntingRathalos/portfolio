<template>
  <v-text-field
    v-model="setPasswordConfirmation"
    :append-icon="passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
    :rules="[rules.required, rules.minCount8]"
    :type="passwordShow ? 'text' : 'password'"
    label="確認用パスワードを入力"
    placeholder="8文字以上"
    outlined
    rounded
    dense
    @click:append="passwordShow = !passwordShow"
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
      passwordShow: false,
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
