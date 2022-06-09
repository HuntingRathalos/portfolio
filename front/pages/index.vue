<template>
  <div class="">
    <v-row align="center" class="grey--text text--darken-3">
      <v-col cols="12" md="6" class="text-right ml-md-auto mx-xs-auto">
        <div class="font-weight-bold mt-6 mb-6" :class="titleSize">
          継続できる500円貯金<br />始めてみませんか。
        </div>
        <div class="font-weight-bold" :class="subTitleSize">
          手軽にあなたの継続を可視化できる<br />貯金記録サービス
        </div>
      </v-col>
      <v-col cols="12" md="6" class="d-flex justify-center">
        <v-img
          :src="require('@/assets/Piggy bank-bro.svg')"
          max-height="400"
          max-width="450"
        >
        </v-img>
      </v-col>
    </v-row>
    <div
      class="mx-auto indigo lighten-4 grey--text text--darken-3 px-6"
      style="max-width: 800px"
    >
      <v-row class="d-flex mt-n8" style="max-height: 600px">
        <v-col class="align-self-center" cols="12" md="7">
          <div class="text-h6 font-weight-bold mb-4">カレンダーへの記録</div>
          <div class="text-body-1">
            カレンダーに印がつくのですぐに振り返ることができます。
          </div>
        </v-col>
        <v-col cols="12" md="5">
          <v-img
            class="mx-auto"
            :src="require('@/assets/Date picker-rafiki.svg')"
            max-height="400"
            max-width="500"
          >
          </v-img>
        </v-col>
      </v-row>
      <v-row class="d-flex mt-n8">
        <v-col class="align-self-center" cols="12" md="7">
          <div class="text-h6 font-weight-bold mb-4">
            グラフによる「可視化」
          </div>
          <div class="text-body-1">
            ２つのグラフによる「可視化」があなたの継続を手伝います。
          </div>
        </v-col>
        <v-col cols="12" md="5">
          <v-img
            class="mx-auto"
            :src="require('@/assets/Pie chart-rafiki.svg')"
            max-height="400"
            max-width="500"
          >
          </v-img>
        </v-col>
      </v-row>
      <v-row class="d-flex mt-n8">
        <v-col class="align-self-center" cols="12" md="7">
          <div class="text-h6 font-weight-bold mb-4">ニュース閲覧機能</div>
          <div class="text-body-1">
            あなたがアプリを開く習慣を身につけることができます。
          </div>
        </v-col>
        <v-col cols="12" md="5">
          <v-img
            class="mx-auto"
            :src="require('@/assets/Exciting news-rafiki.svg')"
            max-height="400"
            max-width="500"
          >
          </v-img>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
export default {
  name: 'IndexPage',
  layout: 'index',
  auth: false,
  computed: {
    titleSize() {
      const brackPointName = this.$vuetify.breakpoint.name
      if (brackPointName === 'xs') {
        return 'text-h5'
      } else if (brackPointName === 'md') {
        return 'text-h4'
      } else {
        return 'text-h3'
      }
    },
    subTitleSize() {
      const brackPointName = this.$vuetify.breakpoint.name
      if (brackPointName === 'xs') {
        return 'text-body-1'
      } else if (brackPointName === 'md') {
        return 'text-h6'
      } else {
        return 'text-h6'
      }
    }
  },
  methods: {
    goRegister() {
      this.$router.push('/register')
    },
    goGuestLogin() {
      this.$router.push('/guest')
    }
  }
}
</script>
