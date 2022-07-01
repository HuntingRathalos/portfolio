<template>
  <v-card height="480px" outlined>
    <div>
      <v-img v-if="news.thumbnail" height="220" :src="news.thumbnail"></v-img>
      <div
        v-else
        class="no-image text-center font-weight-medium text-h6 justify-center"
      >
        画像がありません。
      </div>
    </div>

    <div class="pt-6 px-3 justify-center font-weight-bold text-h6 card-title">
      {{ news.title }}
    </div>

    <div
      class="pt-3 px-4 justify-center font-weight-medium text-body-1 card-text"
    >
      {{ news.description }}
    </div>

    <v-card-actions class="justify-center">
      <v-btn color="deep-purple lighten-2" text @click="moveLink(news.url)">
        もっと見る
      </v-btn>
    </v-card-actions>
  </v-card>
</template>
<script>
export default {
  props: {
    news: {
      type: Object,
      default: null
    }
  },
  methods: {
    moveLink(url) {
      window.open(url, '_blank')
    }
  }
}
</script>
<style scoped>
.no-image {
  height: 220px;
  line-height: 220px;
  border: solid;
}
.card-text {
  height: 90px;
}
.card-title {
  height: 120px;
}
</style>
