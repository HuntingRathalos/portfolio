<template>
  <div class="">
    <v-card outlined class="py-4">
      <bar-chart :chart-data="chartData" :options="options" />
    </v-card>
  </div>
</template>
<script>
import moment from 'moment'
import BarChart from './BarChart.vue'
export default {
  components: { BarChart },
  data() {
    return {
      chartData: null,
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: [
            {
              display: true,
              stacked: false,
              barPercentage: 1.0,
              categoryPercentage: 0.5,
              gridLines: {
                display: false
              }
            }
          ],
          y: [
            {
              gridLines: {
                drawBorder: false
              }
            }
          ]
        }
      }
    }
  },
  // mounted() {
  //   this.getSavesOneWeek()
  // },
  methods: {
    getSavesOneWeek() {
      this.$saveApi
        .getOneWeek()
        .then((res) => {
          const plusCoin = res.data.map((data) => data.pluscoin * 500)
          const minusCoin = res.data.map((data) => data.minuscoin * 500)
          const clickDate = res.data.map((data) => data.click_date)
          this.chartData = {
            labels: clickDate,
            datasets: [
              {
                label: ['貯金額'],
                backgroundColor: '#f87979',
                data: plusCoin
              },
              {
                label: ['出費額'],
                data: minusCoin
              }
            ]
          }
        })
        .catch((err) => err.response || err)
    }
  }
}
</script>
