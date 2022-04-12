<template>
  <v-card width="400px" class="mx-auto mt-5">
    <v-card-title>
      <h1 class="display-1">会員登録</h1>
    </v-card-title>
    <v-card-text>
      <v-form ref="register_form" @submit.prevent="signUp">
        <NameInput :name.sync="form.name" />
        <EmailInput :email.sync="form.email" />
        <PasswordInput :password.sync="form.password" />
        <PasswordConfirmationInput
          :password_confirmation="form.password_confirmation"
        />
        <v-card-actions>
          <v-row justify="end">
            <BaseButton>会員登録</BaseButton>
          </v-row>
        </v-card-actions>
      </v-form>
    </v-card-text>
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
        await this.$axios.get('/sanctum/csrf-cookie')
        const response = await this.$axios
          .post('/api/register', this.form)
          .catch((err) => err.response || err)
        if (response.status === 400) {
          console.log(response)
        }
      }
    }
  }
}
</script>
