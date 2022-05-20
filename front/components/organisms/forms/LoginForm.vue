<template>
  <v-card max-width="500" class="mx-auto mt-5 full-width" flat outlined>
    <v-card-title class="text-center pa-8">
      <h1 class="text-h5 font-weight-bold full-width">ログイン情報入力</h1>
    </v-card-title>
    <v-divider> </v-divider>
    <div class="px-6 py-8">
      <div style="max-width: 336px" class="mx-auto">
        <v-card-text>
          <v-form ref="login_form" @submit.prevent="doLogin">
            <EmailInput :email.sync="form.email" />
            <PasswordInput :password.sync="form.password" />
            <v-card-actions>
              <v-row justify="end" class="pb-8 pt-4">
                <BaseButton :color="btnColor">ログイン</BaseButton>
              </v-row>
            </v-card-actions>
          </v-form>
        </v-card-text>
        <v-divider></v-divider>
        <div class="pt-8 pb-4">
          <span>パスワードをお忘れですか？</span>
          <nuxt-link to="/forgot-password">パスワードをリセットする</nuxt-link>
        </div>
      </div>
    </div>
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
      btnColor: 'indigo accent-2',
      form: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    async doLogin() {
      if (this.$refs.login_form.validate()) {
        // const response = await this.$auth
        //   .loginWith('laravelSanctum', {
        //     data: this.form
        //   })
        await this.$auth
          .loginWith('laravelSanctum', {
            data: this.form
          })
          .catch((err) => console.log(err))
        this.$router.push('/')
        //   .catch((err) => err.response || err)
        // if (response.status === 400) {
        //   console.log(response)
        // }
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
