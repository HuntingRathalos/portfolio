<template>
  <v-card outlined>
    <v-card-title class="text-right">合計 :{{ saveAmount }}円</v-card-title>
    <v-card-text class="black--text text-right">
      <v-row>
        <v-col cols="6">
          <div class="text-body-1">貯金</div>
          <div class="text-body-2 blue--text">{{ plusAmount }}円</div>
        </v-col>
        <v-col cols="6">
          <div class="text-body-1">出費</div>
          <div class="text-body-2 red--text">{{ minusAmount }}円</div>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
<script>
export default {
  data() {
    return {
      saves: [],
      saveAmount: 0,
      plusAmountArray: 0,
      minusAmountArray: 0
    }
  },
  computed: {
    plusAmount() {
      if (this.plusAmountArray.length !== 0) {
        const pluscoin = this.plusAmountArray.reduce((sum, save) => {
          return sum + save.coin * 500
        }, 0)
        return pluscoin
      }
      return 0
    },
    minusAmount() {
      if (this.minusAmountArray.length !== 0) {
        const minuscoin = this.minusAmountArray.reduce((sum, save) => {
          return sum + save.coin * 500
        }, 0)
        return minuscoin
      }
      return 0
    }
  },
  created() {
    const saveAmount = JSON.parse(sessionStorage.getItem('saveAmount'))
    if (saveAmount) {
      this.saveAmount = saveAmount
    }
    this.calcAmount()
  },
  methods: {
    calcAmount() {
      const saves = JSON.parse(sessionStorage.getItem('saves'))
      if (saves.length !== 0) {
        this.plusAmountArray = saves.filter((save) => save.coin > 0)
        this.minusAmountArray = saves.filter((save) => save.coin < 0)
      }
    }
  }
}
</script>
