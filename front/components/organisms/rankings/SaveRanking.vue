<template>
  <div class="">
    <v-card outlined class="pt-8 mx-auto">
      <v-row>
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
        console.log(res.data)
        if(res.data) {
          const tagName = res.data.map((data) => data.tag_name)
          this.rankingArray = res.data
        }
      })
    }
  }
}
</script>
