<template>
  <div class="">
    <v-app-bar app>
      <router-link to="/">
        <v-img
          :src="require('@/assets/logo.png')"
          max-height="56"
          max-width="120"
        >
        </v-img>
      </router-link>
      <v-spacer />

      <v-app-bar-nav-icon
        class="hidden-sm-and-up"
        @click="drawer = true"
      ></v-app-bar-nav-icon>

      <v-toolbar-items class="ml-2 hidden-xs-only">
        <v-btn
          v-for="headerItem in headerItems"
          :key="headerItem.icon"
          class="font-weight-medium"
          text
          @click="doHeaderText(headerItem.text)"
        >
          {{ headerItem.text }}
        </v-btn>
      </v-toolbar-items>
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawer"
      class="hidden-sm-and-up"
      absolute
      temporary
    >
      <v-list nav dense>
        <v-list-item-group active-class="teal--text text--accent-3">
          <v-list-item
            v-for="headerItem in headerItems"
            :key="headerItem.text"
            @click="doHeaderText(headerItem.text)"
          >
            <v-list-item-icon>
              <v-icon>{{ headerItem.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-title>{{ headerItem.text }}</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script>
export default {
  props: {
    headerItems: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      drawer: false
    }
  },
  methods: {
    async doHeaderText(text) {
      switch (text) {
        case 'ログイン':
          this.$router.push('/login')
          break
        case 'ログアウト':
          sessionStorage.clear()
          try {
            await this.$auth.logout()
            this.$router.push('/')
            this.$toast.success('ログアウト')
          } catch {
            this.$toast.error('ログアウトに失敗しました。')
          }
          break
        case '会員登録':
          this.$router.push('/register')
          break
        case 'ゲストログイン':
          this.$router.push('/guest')
          break
      }
    }
  }
}
</script>
