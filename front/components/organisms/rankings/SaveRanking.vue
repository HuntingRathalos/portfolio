<template>
  <div>
    <v-card outlined class="py-8 mx-auto">
      <div
        v-if="rankingArray.length === 0"
        class="text-subtitle-1 font-weight-medium text-center"
      >
        貯金記録がありません。
      </div>
      <v-row v-else>
        <v-col
          v-for="(ranking, index) in rankingArray"
          :key="ranking.tag_name"
          cols="4"
          :ranking="ranking"
        >
          <v-sheet class="text-center">
            <v-badge content="1" overlap left :color="colors[index]">
              <v-icon x-large>{{ ranking.icon_code }}</v-icon>
            </v-badge>
            <div class="text-h6 font-weight-medium">{{ ranking.tag_name }}</div>
            <div class="text-h6 font-weight-medium">
              {{ ranking.tag_count }}
            </div>
          </v-sheet>
        </v-col>
      </v-row>
    </v-card>
  </div>
</template>
<script>
export default {
  data() {
    return {
      rankingArray: [],
      colors: ['yellow darken-1', 'blue-grey lighten-2', 'brown darken-1']
    }
  },
  mounted() {
    this.getSaveRanking()
  },
  methods: {
    getSaveRanking() {
      this.$saveApi.getSaveRanking().then((res) => {
        if (res.data) {
          // const tagName = res.data.map((data) => data.tag_name)
          console.log(res.data)
          this.rankingArray = res.data
        }
      })
    }
  }
}
</script>
