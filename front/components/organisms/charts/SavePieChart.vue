<template>
  <div class="">
    <v-row>
      <v-col cols="12">
        <v-card outlined class="py-4">
          <pie-chart
            v-if="showFlag"
            :chart-data="chartData"
            :options="options"
          />
          <div v-else class="text-subtitle-1 font-weight-medium text-center">
            貯金記録がありません。
          </div>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>
<script>
import PieChart from './PieChart.vue'
export default {
  components: { PieChart },
  data() {
    return {
      showFlag: false,
      chartData: null,
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    }
  },
  mounted() {
    this.getSavesGroupedByTag()
  },
  methods: {
    getSavesGroupedByTag() {
      this.$saveApi
        .getGroupedByTag()
        .then((res) => {
          if (res.data) {
            console.log(res.data)
            const plusCoin = res.data.map((data) => data.pluscoin * 500)
            const tagName = res.data.map((data) => data.tag_name)
            this.chartData = {
              labels: tagName,
              datasets: [
                {
                  backgroundColor: [
                    '#f87979',
                    '#303F9F',
                    '#80DEEA',
                    '#66BB6A',
                    '#FFCA28',
                    '#66BB6A',
                    '#B388FF',
                    '#FF4081'
                  ],
                  data: plusCoin
                }
              ]
            }
            this.showFlag = true
          }
        })
        .catch((err) => err.response || err)
    }
  }
}
</script>
