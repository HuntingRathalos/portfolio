<template>
  <v-card width="400px" class="mx-auto mt-5">
    <v-card-title>
      <h1 class="display-1">ログイン</h1>
    </v-card-title>
    <v-card-text>
      <v-form ref="login_form" @submit.prevent="doLogin">
        <v-text-field
          v-model="form.email"
          :rules="[rules.required, rules.email, rules.maxCount255]"
          prepend-icon="mdi-email-outline"
          label="メールアドレス"
          type="email"
        />
        <v-text-field
          v-model="form.password"
          :rules="[rules.required, rules.minCount8]"
          prepend-icon="mdi-lock"
          label="パスワード"
          type="password"
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
  name: 'LoginPage',
  data() {
    return {
      form: {
        email: '',
        password: ''
      },
      rules: {
        required: (value) => !!value || '必須項目なので値を入力してください。',
        minCount8: (value) =>
          value.length >= 8 || 'パスワードは8文字以上で入力してください。',
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
  methods: {
    async doLogin() {
      if (this.$refs.login_form.validate()) {
        const response = await this.$auth
          .loginWith('laravelSanctum', {
            data: this.form
          })
          .catch((err) => err.response || err)
        if (response.status === 400) {
          console.log(response)
        }
      }
    }
  }
}
</script>
