<template>
  <div class="">
    <div class="text-left">
      <v-btn text color="blue" class="mr-auto mb-2" @click="goNews">
        <v-icon> mdi-chevron-left </v-icon>
        カテゴリー選択へ
      </v-btn>
    </div>
    <v-row justify="center">
      <v-col
        v-for="news in articles"
        :key="news.title"
        cols="11"
        sm="6"
        md="5"
        lg="4"
      >
        <news-item-card :news="news" />
      </v-col>
    </v-row>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
import NewsItemCard from '../../../components/organisms/cards/NewsItemCard.vue'
export default {
  name: 'NewsList',
  components: { NewsItemCard },
  auth: false,
  computed: {
    ...mapGetters('news', {
      articles: 'getArticlesByCategory'
    })
  },
  created() {
    if (this.articles.length) {
      return false
    } else {
      this.$newsApi
        .getNewsByCategory(this.$route.params.category)
        .then((res) => {
          this.getArticles(res.data)
        })
    }
  },
  methods: {
    ...mapActions({
      getArticles: 'news/getArticles'
    }),
    goNews() {
      this.$router.push('/news')
    }
  }
}
</script>
