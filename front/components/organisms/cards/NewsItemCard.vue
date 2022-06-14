<template>
  <v-card>
    <v-img
      height="220"
      src="news.thumbnail"
    ></v-img>

    <v-card-title class="justify-center">{{ news.title }}</v-card-title>

    <v-card-text>
      <div class="text-body-1">
        {{ news.content }}
      </div>
    </v-card-text>

    <v-card-actions class="justify-center">
      <v-btn color="deep-purple lighten-2" text :href="news.url">
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
}
</script>
