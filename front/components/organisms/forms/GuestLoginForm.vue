<template>
  <v-card max-width="500" class="mx-auto mt-5 full-width" flat outlined>
    <v-card-title class="text-center pa-8">
      <h1 class="text-h5 font-weight-bold full-width">ゲストログイン</h1>
    </v-card-title>
    <v-divider> </v-divider>
    <div class="px-6 py-8">
      <div style="max-width: 336px" class="mx-auto">
        <v-card-text>
          <v-form ref="guest_login_form" @submit.prevent="guestLogin">
            <v-text-field
              type="email"
              disabled
              value="guest@example.com"
              outlined
              dense
              rounded
            />
            <v-text-field
              type="text"
              disabled
              value="password"
              outlined
              rounded
              dense
              @click:append="passwordShow = !passwordShow"
            />
            <v-card-actions>
              <v-row justify="end" class="pb-8 pt-4">
                <base-button :color="btnColor">ゲストログイン </base-button>
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
export default {
  components: { BaseButton },
  data() {
    return {
      btnColor: 'indigo accent-2'
    }
  },
  methods: {
    async guestLogin() {
      if (this.$refs.guest_login_form.validate()) {
        try {
          await this.$auth.loginWith('laravelSanctum', {
            data: {
              email: 'guest@example.com',
              password: 'password'
            }
          })
          this.$router.push('/')
          this.$toast.success('ゲストログインに成功しました。')
        } catch {
          this.$toast.error('ゲストログインに失敗しました。')
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
