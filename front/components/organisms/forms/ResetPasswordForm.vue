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
          <v-form ref="reset_password_form" @submit.prevent="resetPassword">
            <EmailInput :email.sync="form.email" />
            <PasswordInput :password.sync="form.password" />
            <PasswordConfirmationInput
              :password_confirmation="form.password_confirmation"
            />
            <v-card-actions>
              <v-row class="pt-4" justify="end">
                <BaseButton :color="btnColor">パスワードリセット</BaseButton>
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
import PasswordConfirmationInput from '../../atoms/inputs/PasswordConfirmationInput.vue'
import PasswordInput from '../../atoms/inputs/PasswordInput.vue'
export default {
  components: {
    EmailInput,
    PasswordInput,
    PasswordConfirmationInput,
    BaseButton
  },
  data() {
    return {
      btnColor: 'indigo accent-2',
      form: {
        email: this.$route.query.email || '',
        password: '',
        password_confirmation: '',
        token: this.$route.query.token || ''
      }
    }
  },
  methods: {
    async resetPassword() {
      if (this.$refs.reset_password_form.validate()) {
        await this.$axios.get('sanctum/csrf-cookie')
        await this.$axios
          .post('/api/reset-password', this.form)
          .then(this.$toast.success('パスワードリセットに成功しました。'))
      }
    }
  }
}
</script>
