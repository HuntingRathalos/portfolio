<template>
  <v-card
    class="mx-auto mb-3"
    :color="news.color"
    dark
    elevation="3"
    outlined
    max-width="400px"
    @click="goNewsList"
  >
    <v-card-title>
      <v-icon large left>
        {{ news.icon }}
      </v-icon>
      <span class="text-h6 font-weight-light">
        {{ news.category }}
      </span>
    </v-card-title>
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
   created() {
    this.$store.dispatch('news/updateCategory', this.news.category)
  },
  methods: {
    goNewsList() {
      const category = this.news.category
      this.$router.push({ path: `/news/${category}` })
    }
  },
}
</script>
