<template>
  <v-row justify="center">
    <v-col lg="6" sm="8" cols="12">
      <v-tabs
        v-model="tab"
        fixed-tabs
        centered
        background-color="cyan darken-1"
        color="white"
        slider-color="orange"
        icons-and-text
      >
        <v-tab class="ma-0 pa-0" href="#post_list">
          新着順
          <v-icon>mdi-clock-time-eight</v-icon>
        </v-tab>
        <v-tab class="ma-0 pa-0" href="#post_like">
          いいね
          <v-icon>mdi-heart-settings</v-icon>
        </v-tab>
      </v-tabs>
      <v-tabs-items v-model="tab">
        <v-tab-item class="pa-1">
          <post-item-card
            v-for="post in posts"
            :key="post.id"
            :post="post"
            @post-id-send="sendPostId(post.id)"
          />
        </v-tab-item>
        <v-tab-item class="pa-1">
          <post-like-card />
        </v-tab-item>
      </v-tabs-items>
    </v-col>
  </v-row>
</template>
<script>
import PostItemCard from '../components/organisms/cards/PostItemCard.vue'
import PostLikeCard from '../components/organisms/cards/PostLikeCard.vue'
export default {
  name: 'TimelinePage',
  components: { PostItemCard, PostLikeCard },
  auth: false,
  data() {
    return {
      tab: 'post_list',
      postId: null
    }
  },
  methods: {
    sendPostId(id) {
      this.postId = id
      // モーダルにpropsで渡す
      // モーダルをひらく
      // モーダルでid番目のpostを取得して反映させる
    }
  }
}
</script>
