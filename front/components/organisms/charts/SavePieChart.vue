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
          <div v-else style="max-width: 820px" class="mx-auto">
            <v-card flat>
              <v-img
                class="mx-auto"
                :src="require('@/assets/No data-rafiki.svg')"
                max-height="350"
                max-width="400"
              >
              </v-img>
              <p class="text-center">貯金記録がありません。</p>
              <p class="text-center">記録を付けてみましょう！</p>
            </v-card>
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
                    '#F24141',
                    '#303F9F',
                    '#80DEEA',
                    '#FA8D2D',
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
