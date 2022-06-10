<template>
  <div>
    <news-category-card
      v-for="news in newsArray"
      :key="news.category"
      :news="news"
    />
  </div>
</template>
<script>
import NewsCategoryCard from '../../components/molecules/cards/NewsCategoryCard.vue'
export default {
  name: 'NewsPage',
  components: { NewsCategoryCard },
  auth: false,
  data() {
    return {
      newsArray: [
        {
          color: '#f87979',
          icon: 'mdi-handshake-outline',
          category: 'ビジネス'
        },
        {
          color: '#303F9F',
          icon: 'mdi-robot-happy-outline',
          category: 'エンターテイメント'
        },
        {
          color: '#80DEEA',
          icon: 'mdi-bottle-tonic-plus-outline',
          category: '健康'
        },
        {
          color: '#66BB6A',
          icon: 'mdi-flask-outline',
          category: '科学'
        },
        {
          color: '#FFCA28',
          icon: 'mdi-ski',
          category: 'スポーツ'
        },
        {
          color: '#B388FF',
          icon: 'mdi-robot',
          category: 'テクノロジー'
        }
      ]
    }
  }
}
</script>
