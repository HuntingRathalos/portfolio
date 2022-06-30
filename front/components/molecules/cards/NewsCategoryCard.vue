<template>
  <v-card
    class="mx-auto mb-3"
    color="orange"
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
import { mapGetters, mapActions } from 'vuex'
export default {
  props: {
    news: {
      type: Object,
      default: null
    }
  },
  methods: {
    ...mapActions({
      updateCategory: 'news/updateCategory'
    }),
    goNewsList() {
      const storeProperty = this.news.storeProperty
      this.updateCategory(storeProperty)
      this.$router.push({ path: `/news/${storeProperty}` })
    }
  }
}
</script>
