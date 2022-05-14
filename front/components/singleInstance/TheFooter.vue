<template>
  <v-bottom-navigation app color="indigo accent-2" grow>
    <v-btn @click="goHome">
      <span>ホーム</span>

      <v-icon>mdi-home</v-icon>
    </v-btn>

    <v-btn @click="goCalendar">
      <span>記録</span>

      <v-icon>mdi-calendar-check</v-icon>
    </v-btn>

    <v-btn @click="goUserList">
      <span>ユーザーリスト</span>

      <v-icon>mdi-format-list-bulleted</v-icon>
    </v-btn>
  </v-bottom-navigation>
</template>
<script>
export default {
  methods: {
    goHome() {
      this.$router.push('/top-page')
    },
    goCalendar() {
      this.$router.push('/save')
    },
    goUserList() {
      this.$router.push('/users')
    }
  }
}
</script>
