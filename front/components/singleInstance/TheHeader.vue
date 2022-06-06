<template>
  <v-app-bar app color="white">
    <v-img :src="require('@/assets/logo.png')" max-height="56" max-width="120">
    </v-img>
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
export default {
  data() {
    return {
      headerTexts: ['ログイン', 'ログアウト']
    }
  },
  methods: {
    async doHeaderText(headerText) {
      if (headerText === 'ログイン') {
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
