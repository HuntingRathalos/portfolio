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

    <v-btn @click="goTimeline">
      <span>振り返り</span>

      <v-icon>mdi-format-clock-outline</v-icon>
    </v-btn>

    <v-btn @click="goNews">
      <span>ニュース</span>

      <v-icon>mdi-format-newspaper-variant</v-icon>
    </v-btn>

    <v-btn @click="goStatistics">
      <span>統計</span>

      <v-icon>mdi-format-chart-bar</v-icon>
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
    goTimeline() {
      this.$router.push('/timeline')
    },
    goNews() {
      this.$router.push('/news')
    },
    goStatistics() {
      this.$router.push('/statistics')
    },
  }
}
</script>
