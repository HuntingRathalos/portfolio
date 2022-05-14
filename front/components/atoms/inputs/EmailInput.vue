<template>
  <v-text-field
    v-model="setEmail"
    :rules="[rules.required, rules.email, rules.maxCount255]"
    label="メールアドレスを入力"
    placeholder="your@email.com"
    type="email"
    outlined
    dense
    rounded
  />
</template>
<script>
export default {
  props: {
    email: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      rules: {
        required: (value) => !!value || '必須項目なので値を入力してください。',
        maxCount255: (value) =>
          value.length <= 255 || '文字数をオーバーしています。',
        email: (value) => {
          const pattern =
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || '正しい形式で入力してください。'
        }
      }
    }
  },
  computed: {
    setEmail: {
      get() {
        return this.email
      },
      set(newVal) {
        return this.$emit('update:email', newVal)
      }
    }
  }
}
</script>
