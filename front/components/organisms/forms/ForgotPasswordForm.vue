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
            <email-input :email.sync="form.email" />
            <v-card-actions>
              <v-row class="pt-4" justify="end">
                <base-button :color="btnColor">
                  パスワードリセットメール送信
                </base-button>
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
      btnColor: 'orange',
      form: {
        email: ''
      }
    }
  },
  methods: {
    async sendForgotPasswordEmail() {
      if (this.$refs.forgot_password_form.validate()) {
        try {
          await this.$axios.get('sanctum/csrf-cookie')
          const response = await this.$axios.post(
            '/api/forgot-password',
            this.form
          )
          this.$toast.success('メールを送信しました。')
        } catch {
          this.$toast.error('メールの送信に失敗しました。')
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
