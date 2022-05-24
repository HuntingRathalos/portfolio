<template>
  <v-card max-width="500" class="mx-auto mt-5 full-width" flat outlined>
    <v-card-title class="text-center pa-8">
      <h1 class="text-h5 font-weight-bold full-width">
        パスワードリセット情報入力
      </h1>
    </v-card-title>
    <v-divider> </v-divider>
    <div class="px-6 py-8">
      <div style="max-width: 336px" class="mx-auto">
        <v-card-text>
          <v-form
            ref="forgot_password_form"
            @submit.prevent="sendForgotPasswordEmail"
          >
            <EmailInput :email.sync="form.email" />
            <v-card-actions>
              <v-row class="pt-4" justify="end">
                <BaseButton class="pt-4" :color="btnColor"
                  >パスワードリセットメール送信</BaseButton
                >
              </v-row>
            </v-card-actions>
          </v-form>
        </v-card-text>
      </div>
    </div>
  </v-card>
</template>
<script>
import BaseButton from '../../atoms/buttons/BaseButton.vue'
import EmailInput from '../../atoms/inputs/EmailInput.vue'
export default {
  components: { EmailInput, BaseButton },
  data() {
    return {
      btnColor: 'indigo accent-2',
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
          .then(this.$toast.success('パスワードリセットメールを送信しました。'))
          .catch((err) => err.response || err)

        if (response.status === 400) {
          console.log(response)
        }
      }
    }
  }
}
</script>
<style scoped>
.full-width {
  width: 100%;
}
</style>
