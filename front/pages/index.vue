<template>
  <div class="">
    <v-row align="center">
      <v-col cols="12" md="6" class="text-right ml-auto">
        <div class="text-h3 font-weight-bold mt-6 mb-6">
          継続できる500円貯金<br />始めませんか。
        </div>
        <div class="text-h6 font-weight-bold">
          手軽にあなたの継続を可視化できる<br />貯金記録サービス
        </div>
      </v-col>
      <v-col cols="12" md="6" class="d-flex justify-center">
        <v-img
          :src="require('@/assets/endure_person.png')"
          max-height="400"
          max-width="400"
        >
        </v-img>
      </v-col>
    </v-row>
    <div class="grey lighten-2">
      <v-container>
        <v-row>
          <v-col cols="12" md="10">
            <div class="text-body-1">貯金した日をカレンダーに記録</div>
            <div class="text-body-2">
              カレンダーに印がつくのですぐに振り返ることができます。
            </div>
          </v-col>
          <v-col cols="12" md="2">
            <v-img :src="require('@/assets/endure_person.png')"> </v-img>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="2">
            <v-img :src="require('@/assets/endure_person.png')"> </v-img>
          </v-col>
          <v-col cols="12" md="10">
            <div class="text-body-1">グラフによる「可視化」</div>
            <div class="text-body-2">
              ２つのグラフによる「可視化」があなたの継続を手伝います。
            </div>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="10">
            <div class="text-body-1">ニュース閲覧</div>
            <div class="text-body-2">
              あなたがアプリを開く習慣を身につけることを手伝います。
            </div>
          </v-col>
          <v-col cols="12" md="2">
            <v-img :src="require('@/assets/endure_person.png')"> </v-img>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </div>
</template>

<script>
export default {
  name: 'IndexPage',
  layout: 'index',
  auth: false,
  data() {
    return {
      btnColor: 'teal lighten-3'
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
