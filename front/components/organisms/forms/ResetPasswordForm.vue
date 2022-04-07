<template>
  <v-card width="400px" class="mx-auto mt-5">
    <v-card-title>
      <h1 class="display-1">パスワードリセット</h1>
    </v-card-title>
    <v-card-text>
      <v-form ref="reset_password_form" @submit.prevent="resetPassword">
        <EmailInput :email.sync="form.email" />
        <PasswordInput :password.sync="form.password" />
        <PasswordConfirmationInput
          :password_confirmation="form.password_confirmation"
        />
        <v-card-actions>
          <v-row justify="end">
            <BaseButton>パスワードリセット</BaseButton>
          </v-row>
        </v-card-actions>
      </v-form>
    </v-card-text>
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
        try {
          await this.$axios.get('sanctum/csrf-cookie')
          await this.$axios.post('/api/reset-password', this.form)
        } catch (e) {}
      }
    }
  }
}
</script>
