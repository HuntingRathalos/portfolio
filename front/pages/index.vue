<template>
  <v-row justify="center" align="center">
    <v-col cols="12" md="6">
      <v-img
        :src="require('@/assets/logo.png')"
        max-height="220"
        max-width="440"
      >
      </v-img>
      <div class="text-body-1">継続できる500貯金始めませんか。</div>
      <base-button :color="btnColor" @click="goRegister"
        >会員登録する</base-button
      >
      <base-button :color="btnColor" @click="goGuestLogin"
        >ゲストログインしてみる</base-button
      >
      <div class="text-body-2">
        手軽にあなたの継続を可視化できる貯金記録サービス
      </div>
    </v-col>
    <v-col cols="12" md="6">
      <v-img :src="require('@/assets/endure_person.png')"> </v-img>
    </v-col>
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
  </v-row>
</template>

<script>
import BaseButton from '../components/atoms/buttons/BaseButton.vue'
export default {
  name: 'IndexPage',
  components: { BaseButton },
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
