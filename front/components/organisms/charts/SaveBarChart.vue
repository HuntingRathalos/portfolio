<template>
  <div class="">
    <v-card outlined class="py-4">
    <bar-chart
        :chart-data="chartData"
        :options="options"
      />
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
      chartData: {
          // labels: this.saves.map(save => save.click_date),
          labels: ['2022-04-28', '2022-04-29','2022-04-30', '2022-05-01', '2022-05-01', '2022-05-02', '2022-05-03'],
          datasets: [
              {
              label: ['貯金額'],
              backgroundColor: '#f87979',
              data: [500, 2000,2000, 4000, 500, 1000,0]
              },
              {
              label: ['出費額'],
              data: [500, 2000,1000, 2000, 500, 1000,0]
              },
          ]
      },
      options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
        xAxes: [{
          display: true,
          stacked: false,
          barPercentage: 1.0,
          categoryPercentage: 0.5,
          gridLines: {
            display: false
          }
        }],
        yAxes: [{
          gridLines: {
            drawBorder: false
          }
        }]
      }
      },
      savesOneWeek: [],
      as: [2,3],
      saves:[
       {
        id: 1,
        user_id: 1,
        tag_id: 2,
        icon_id: 1,
        coin: 3,
        memo: 'aaa',
        click_date: '2022-04-28',
      },
       {
        id: 1,
        user_id: 1,
        tag_id: 2,
        icon_id: 1,
        coin: 3,
        memo: 'aaa',
        click_date: '2022-04-29',
      },
    ]
    }
  },
   mounted() {
    //  this.getSavesOneWeek()
    //  if(this.saves.length > 0) {
    //    for(let i = 0; i < 6; i++){
    //      this.processSaves(i)
    //    }
    //  }
  },
  methods: {
    getSavesOneWeek() {
      this.saves = JSON.parse(sessionStorage.getItem('saves')).filter(
        (save) => {
          const clickDate = moment(save.click_date)
          const startDate = moment()
            .startOf('isoWeek')
            .format('YYYY-MM-DD')
          const endDate = moment().endOf('isoWeek').format('YYYY-MM-DD')
          return clickDate.isBetween(startDate, endDate)
        }
      )
      this.saves.sort((a, b) => (a.click_date < b.click_date ? -1 : 1))
    },
    processSaves(num) {
      const day = moment().add(num, 'd').format('YYYY-MM-DD')
      const savesOfDay = this.saves.filter(
        (save) => {
          return day === save.click_date
        })
        let plusCoinSum = 0
        let minusCoinSum = 0
        if(savesOfDay.length > 0) {
          for(let i = 0; i < savesOfDay.length; i++){
            savesOfDay[i].coin > 0 ?  plusCoinSum +=savesOfDay[i].coin :  minusCoinSum +=savesOfDay[i].coin
          }
          const save = {
            plusCoin: plusCoinSum,
            minusCoin: minusCoinSum,
            click_date: day
          }
          this.savesOneWeek.push(save)
        } else {
          const save = {
            plusCoin: 0,
            minusCoin: 0,
            click_date: moment().format('YYYY-MM-DD')
          }
          this.savesOneWeek.push(save)
        }
    }
  },

}
</script>
