<template>
  <div>
    <v-row>
      <v-col class="mx-auto" cols="12">
        <save-statistics-card />
      </v-col>
    </v-row>
    <v-row>
      <v-col class="mx-auto" cols="12">
        <sub-title-card class="pb-1">
          <template #subTitle>これまでの統計</template>
        </sub-title-card>
        <save-pie-chart />
      </v-col>
      <v-col cols="12">
        <v-btn block color="orange" dark rounded @click="goSave">
          貯金記録を作成する
        </v-btn>
      </v-col>
    </v-row>
  </div>
</template>
<script>
import SubTitleCard from '../components/molecules/cards/SubTitleCard.vue'
import SaveStatisticsCard from '../components/organisms/cards/SaveStatisticsCard.vue'
import SavePieChart from '../components/organisms/charts/SavePieChart.vue'
export default {
  name: 'StatisticsPage',
  components: { SaveStatisticsCard, SavePieChart, SubTitleCard },
  methods: {
    goSave() {
      this.$router.push('/save')
    }
  }
}
</script>
