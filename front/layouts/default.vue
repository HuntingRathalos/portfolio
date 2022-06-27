<template>
  <v-app :style="{ background: $vuetify.theme.themes.light.background }">
    <the-header :header-items="headerItems" />
    <v-main>
      <v-container>
        <Nuxt />
      </v-container>
    </v-main>
    <the-footer />
  </v-app>
</template>

<script>
import TheFooter from '../components/singleInstance/TheFooter.vue'
import TheHeader from '../components/singleInstance/TheHeader.vue'
export default {
  name: 'DefaultLayout',
  components: { TheHeader, TheFooter },
  data() {
    return {
      headerItems: [
        {
          text: 'ログアウト',
          icon: 'mdi-logout'
        }
      ]
    }
  }
}
</script>
