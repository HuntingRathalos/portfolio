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
        <EmailInput :email.sync="form.email" />
        <v-card-actions>
          <v-row justify="end">
            <BaseButton>パスワードリセットメール送信</BaseButton>
          </v-row>
        </v-card-actions>
      </v-form>
    </v-card-text>
  </v-card>
</template>
<script>
import BaseButton from '../../atoms/buttons/BaseButton.vue'
import EmailInput from '../../atoms/inputs/EmailInput.vue'
export default {
  components: { EmailInput, BaseButton },
  data() {
    return {
      form: {
        email: ''
      }
    }
  },
  methods: {
    async sendForgotPasswordEmail() {
      if (this.$refs.forgot_password_form.validate()) {
        await this.$axios.get('sanctum/csrf-cookie')
        const response = await this.$axios
          .post('/api/forgot-password', this.form)
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
