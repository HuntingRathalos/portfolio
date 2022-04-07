<template>
  <v-card width="400px" class="mx-auto mt-5">
    <v-card-title>
      <h1 class="display-1">ログイン</h1>
    </v-card-title>
    <v-card-text>
      <v-form ref="login_form" @submit.prevent="doLogin">
        <EmailInput :email.sync="form.email" />
        <PasswordInput :password.sync="form.password" />
        <v-card-actions>
          <v-row justify="end">
            <BaseButton>ログイン</BaseButton>
          </v-row>
        </v-card-actions>
      </v-form>
    </v-card-text>
  </v-card>
</template>
<script>
import BaseButton from '../../atoms/buttons/BaseButton.vue'
import EmailInput from '../../atoms/inputs/EmailInput.vue'
import PasswordInput from '../../atoms/inputs/PasswordInput.vue'
export default {
  components: { EmailInput, PasswordInput, BaseButton },
  data() {
    return {
      form: {
        email: '',
        password: ''
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
