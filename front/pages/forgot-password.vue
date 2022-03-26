<template>
  <v-card width="400px" class="mx-auto mt-5">
    <v-card-title>
      <h1 class="display-1">パスワードリセット</h1>
    </v-card-title>
    <v-card-text>
      <v-form
        ref="forgot_password_form"
        @submit.prevent="sendForgotPasswordEmail"
      >
        <v-text-field
          v-model="form.email"
          :rules="[rules.required, rules.email, rules.maxCount255]"
          prepend-icon="mdi-email-outline"
          label="メールアドレス"
          type="email"
        />
        <v-card-actions>
          <v-row justify="end">
            <v-btn class="info" type="submit">ログイン </v-btn>
          </v-row>
        </v-card-actions>
      </v-form>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: ''
      },
      rules: {
        required: (value) => !!value || '必須項目なので値を入力してください。',
        maxCount255: (value) =>
          value.length <= 255 || '文字数をオーバーしています。',
        email: (value) => {
          const pattern =
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return (
            pattern.test(value) ||
            '正しい形式のメールアドレスを入力してください。'
          )
        }
      }
    }
  },
  methods: {
    async sendForgotPasswordEmail() {
      if (this.$refs.forgot_password_form.validate()) {
        await this.$axios.get('sanctum/csrf-cookie')
        const response = await this.$axios
          .post('forgot-password', this.form)
          .then(console.log())
          .catch((err) => err.response || err)

        if (response.status === 400) {
          console.log(response)
        }
      }
    }
  }
}
</script>
