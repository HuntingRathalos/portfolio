<template>
  <v-app-bar
    app
    color="white"
  >
  <the-logo />
    <v-toolbar-title class="text-subtitle-2">
      {{ appName }}
    </v-toolbar-title>
     <v-spacer />

    <v-toolbar-items class="ml-2">
      <v-btn
        v-for="headerText in headerTexts"
        :key="headerText"
        class="font-weight-medium"
        text
        @click="doHeaderText(headerText)"
      >
        {{ headerText }}
      </v-btn>
    </v-toolbar-items>
  </v-app-bar>
</template>

<script>
import TheLogo from './TheLogo.vue'
export default {
  components: { TheLogo },
  data ({ $config: { appName } }) {
    return {
      appName,
      headerTexts: [
        'ログイン',
        'ログアウト'
      ]
    }
  },
  methods: {
    async doHeaderText(headerText) {
      if(headerText === 'ログイン') {
        this.$router.push('login')
      } else {
        sessionStorage.removeItem('target')
        sessionStorage.removeItem('saves')
        sessionStorage.removeItem('saveAmount')
        sessionStorage.removeItem('users')
        sessionStorage.removeItem('followUsers')
        await this.$auth.logout()
        this.$router.push('login')
      }
    }
  }
}
</script>
