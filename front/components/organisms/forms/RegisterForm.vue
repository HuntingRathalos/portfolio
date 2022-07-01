<template>
  <v-card max-width="500" class="mx-auto mt-5 full-width" flat outlined>
    <v-card-title class="text-center pa-8">
      <h1 class="text-h5 font-weight-bold full-width">会員登録情報入力</h1>
    </v-card-title>
    <v-divider> </v-divider>
    <div class="px-6 py-8">
      <div style="max-width: 336px" class="mx-auto">
        <v-card-text>
          <v-form ref="register_form" @submit.prevent="signUp">
            <name-input :name.sync="form.name" />
            <email-input :email.sync="form.email" />
            <password-input :password.sync="form.password" />
            <password-confirmation-input
              :password-confirmation.sync="form.password_confirmation"
            />
            <v-card-actions>
              <v-row class="pt-4" justify="end">
                <base-button :color="btnColor">会員登録</base-button>
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
import NameInput from '../../atoms/inputs/NameInput.vue'
import PasswordConfirmationInput from '../../atoms/inputs/PasswordConfirmationInput.vue'
import PasswordInput from '../../atoms/inputs/PasswordInput.vue'
export default {
  components: {
    EmailInput,
    PasswordInput,
    PasswordConfirmationInput,
    BaseButton,
    NameInput
  },
  data() {
    return {
      btnColor: 'orange',
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  methods: {
    async signUp() {
      if (this.$refs.register_form.validate()) {
        try {
          await this.$axios.get('/sanctum/csrf-cookie')
          const response = await this.$axios.post('/api/register', this.form)
          this.$router.push('/login')
          this.$toast.success('会員登録に成功しました。')
        } catch {
          this.$toast.error('会員登録に失敗しました。')
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
