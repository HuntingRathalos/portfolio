<template>
  <v-app :style="{ background: $vuetify.theme.themes.light.background }">
    <the-header :header-texts="headerTexts" />
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
      headerTexts: ['会員登録', 'ゲストログイン', 'ログイン']
    }
  },
  methods: {
    async doLogout() {
      try {
        await this.$auth.logout()
      } catch (e) {}
    }
  }
}
</script>
