<template>
  <div class="">
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card-title>目標 旅行</v-card-title>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="6">
        <simple-card>
          <template #amountName>目標額</template>
          <template #amount>{{ target.amount }}円</template>
          <template #content>目標まで :{{ remainAmount }}円</template>
        </simple-card>
      </v-col>
      <v-col cols="6">
        <simple-card>
          <template #amountName>貯金額</template>
          <template #amount>{{ saveAmount }}円</template>
          <template #content>今日 :0円</template>
        </simple-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <save-bar-chart />
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="10" class="mx-auto">
        <save-ranking />
      </v-col>
    </v-row>
  </div>
</template>
<script>
import SimpleCard from '../components/molecules/cards/SimpleCard.vue'
import SaveBarChart from '../components/organisms/charts/SaveBarChart.vue'
import SaveRanking from '../components/organisms/rankings/SaveRanking.vue'
export default {
  name: 'TopPage',
  components: { SimpleCard, SaveBarChart, SaveRanking },
  data() {
    return {
      target: {
        amount: 0
      },
      saveAmount: 0,
      remainAmount: 0
    }
  },
  created() {
    const saveAmount = JSON.parse(sessionStorage.getItem('saveAmount'))
    if (saveAmount) {
      this.saveAmount = JSON.parse(sessionStorage.getItem('saveAmount'))
      this.getTarget()
    } else {
      this.getSaves()
      this.getSavesAmount()
      this.getTarget()
    }
  },
  mounted() {
    const users = JSON.parse(sessionStorage.getItem('users'))
    if (!users || users === undefined) {
      this.getUsers()
      this.getFollowUsers()
    }
  },
  methods: {
    getSaves() {
      this.$saveApi.get().then((res) => {
        sessionStorage.setItem('saves', JSON.stringify(res.data))
      })
    },
    getSavesAmount() {
      this.$saveApi.getSavesAmount().then((res) => {
        if (res.data !== '') {
          sessionStorage.setItem('saveAmount', JSON.stringify(res.data))
          this.saveAmount = res.data
        }
      })
    },
    getTarget() {
      this.$targetApi.get().then((res) => {
        if (res.data !== '') {
          Object.assign(this.target, res.data)
          sessionStorage.setItem('target', JSON.stringify(res.data))
          const target = JSON.parse(sessionStorage.getItem('target'))
          const saveAmount = JSON.parse(sessionStorage.getItem('saveAmount'))
          if (target.amount - saveAmount <= 0) {
            this.remainAmount = 0
          } else {
            this.remainAmount = target.amount - saveAmount
          }
          this.target = target
        }
      })
    },
    getUsers() {
      this.$userApi.getUsersExceptMyself().then((res) => {
        console.log(res.data)
        sessionStorage.setItem('users', JSON.stringify(res.data))
      })
    },
    getFollowUsers() {
      this.$userApi.getFollowUsers().then((res) => {
        console.log(res.data)
        sessionStorage.setItem('followUsers', JSON.stringify(res.data))
      })
    }
  }
}
</script>
