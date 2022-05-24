<template>
  <div class="">
    <v-row>
      <v-col class="mx-auto" cols="12">
        <v-card outlined>
          <v-card-title class="text-center">これまでの統計</v-card-title>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col class="mx-auto" cols="12">
        <save-statistics-card />
      </v-col>
    </v-row>
    <v-row>
      <v-col class="mx-auto" cols="12">
        <save-pie-chart />
      </v-col>
    </v-row>
  </div>
</template>
<script>
import SaveStatisticsCard from '../components/organisms/cards/SaveStatisticsCard.vue'
import SavePieChart from '../components/organisms/charts/SavePieChart.vue'
export default {
  name: 'StatisticsPage',
  components: { SaveStatisticsCard, SavePieChart }
}
</script>
