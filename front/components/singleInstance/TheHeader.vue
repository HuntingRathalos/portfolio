<template>
  <div class="">
    <v-app-bar app :color="headerColor">
      <v-img
        :src="require('@/assets/logo.png')"
        max-height="56"
        max-width="120"
      >
      </v-img>
      <v-spacer />

      <!-- <v-app-bar-nav-icon
        class="hidden-sm-and-down"
        @click="drawer = true"
      ></v-app-bar-nav-icon> -->

      <v-toolbar-items class="ml-2 hidden-xs-only">
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
    <!-- <v-navigation-drawer
      v-model="drawer"
      absolute
      temporary
      right
    >
      <v-list
        nav
        dense
      >
        <v-list-item-group
          v-model="group"
          active-class="deep-purple--text text--accent-4"
        >
          <v-list-item
            v-for="menuItem in menuItems"
            :key="menuItem.text"
          >
            <v-list-item-icon>
              <v-icon>{{ menuItem.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-title>{{ menuItem.text }}</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-icon>
              <v-icon>mdi-login</v-icon>
            </v-list-item-icon>
            <v-list-item-title>ログイン</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-icon>
              <v-icon>mdi-logout</v-icon>
            </v-list-item-icon>
            <v-list-item-title>ログアウト</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer> -->
  </div>
</template>

<script>
export default {
  props: {
    headerColor: {
      type: String,
      default: 'white'
    },
    headerTexts: {
      type: Array,
      default: null
    }
  },
  // data() {
  //   return {
  //     drawer: false,
  //   }
  // },
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
