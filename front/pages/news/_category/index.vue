<template>
  <div class="">
    <div class="text-left">
      <v-btn to="/news" text color="blue" nuxt class="mr-auto">
        <v-icon> mdi-chevron-left </v-icon>
        カテゴリー選択へ
      </v-btn>
    </div>
    <v-row justify="center">
      <v-col
        v-for="news in newsArray"
        :key="news.id"
        cols="12"
        sm="6"
        md="4"
        lg="3"
      >
        <news-item-card :news="news" />
      </v-col>
    </v-row>
  </div>
</template>
<script>
import NewsItemCard from '../../../components/organisms/cards/NewsItemCard.vue'
export default {
  name: 'NewsList',
  components: { NewsItemCard },
  auth: false,
  data() {
    return {
      newsArray: [
        {
          id: 1
        },
        {
          id: 2
        },
        {
          id: 3
        },
        {
          id: 4
        },
        {
          id: 5
        },
        {
          id: 6
        }
      ]
    }
  }
  // methods: {
  //   goNewsDetail() {
  //     const category = this.$route.params.category
  //     this.$router.push({ path: `/news/${category}/${id}`})
  //     this.$router.push({ path: `/news/${category}/1`})
  //   }
  // }
}
</script>
