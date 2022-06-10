<template>
  <v-card>
    <v-img
      height="220"
      src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
    ></v-img>

    <v-card-title class="justify-center">Title</v-card-title>

    <v-card-text>
      <div class="text-body-1">
        Content
        {{ news.id }}
      </div>
    </v-card-text>

    <v-card-actions class="justify-center">
      <v-btn color="deep-purple lighten-2" text :href="記事のurl">
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
  }
}
</script>
