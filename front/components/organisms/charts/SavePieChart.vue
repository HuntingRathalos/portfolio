<template>
  <div class="">
    <v-row>
      <v-col cols="12">
        <v-card outlined class="py-4">
          <pie-chart :chart-data="chartData" :options="options" />
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
      // chartData: {
      //         labels: ['本', '食べ物', '漫画','漫画','漫画','漫画','漫画','漫画'],
      //         datasets: [
      //           {
      //             backgroundColor: ['#f87979', 'brue', 'yellow', 'blue'],
      //             data: [5000, 3000, 1000, 1000,1000,1000,1000,1000]
      //           },
      //         ]
      //       },
      chartData: null,
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    }
  }
  // mounted() {
  //   this.getSavesGroupedByTag()
  // },
  // methods: {
  // getSavesGroupedByTag() {
  //     this.$saveApi.getGroupedByTag
  //       .then((res) => {
  //         if(res.data) {
  //           this.saves = res.data
  //           const plusCoin = res.data.map((data) => data.pluscoin * 500)
  //           const tagName = res.data.map((data) => data.tag_name)
  //           this.chartData = {
  //             labels: tagName,
  //             datasets: [
  //               {
  //                 backgroundColor: ['#f87979', 'brue', 'yellow'],
  //                 data: plusCoin
  //               },
  //             ]
  //           }
  //         }
  //       })
  //       .catch((err) => err.response || err)
  //   }
  // }
}
</script>
