<template>
  <v-card outlined>
    <v-card-title class="text-right">合計 :{{ saveAmount }}</v-card-title>
    <v-card-text class="black--text text-right">
      <v-row>
        <v-col cols="6">
          <div class="text-body-1">貯金</div>
          <div class="text-body-2 red--text">{{ plusAmount }}円</div>
        </v-col>
        <v-col cols="6">
          <div class="text-body-1">出費</div>
          <div class="text-body-2 blue--text">{{ minusAmount }}円</div>
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
      saveAmount: null,
      plusAmountArray: 0,
      minusAmountArray: 0
    }
  },
  computed: {
    plusAmount() {
      if (this.plusAmountArray !== 0) {
        this.plusAmountArray.reduce((sum, save) => {
          return sum + save.coin * 500
        }, 0)
      }
      return 0
    },
    minusAmount() {
      if (this.plusAmountArray !== 0) {
        this.plusAmountArray.reduce((sum, save) => {
          return sum + save.coin * 500
        }, 0)
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
