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
          text: 'トップページ',
          icon: 'mdi-home-floor-1'
        }
      ]
    }
  }
}
</script>
