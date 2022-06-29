<template>
  <v-app :style="{ background: $vuetify.theme.themes.light.background }">
    <the-header :header-items="headerItems" />
    <v-main>
      <v-container>
        <Nuxt />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import TheHeader from '../components/singleInstance/TheHeader.vue'
export default {
  name: 'DefaultLayout',
  components: { TheHeader },
  data() {
    return {
      headerItems: [
        {
          text: '会員登録',
          icon: 'mdi-account-plus'
        },
        {
          text: 'ゲストログイン',
          icon: 'mdi-human-greeting-variant'
        },
        {
          text: 'ログイン',
          icon: 'mdi-login'
        }
      ]
    }
  }
}
</script>
