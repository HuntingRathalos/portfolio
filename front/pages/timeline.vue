<template>
  <v-container>
    <create-post-modal />
    <edit-post-modal :post-id="postId" />
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
            <v-col cols="12">
              <v-btn
                block
                color="orange"
                dark
                rounded
                @click="openCreatePostModal"
              >
                新しいガジェットを追加する
              </v-btn>
            </v-col>
            <post-item-card
              v-for="post in posts"
              :key="post.id"
              :post="post"
              @open-edit-post-modal="openEditPostModal(post.id)"
              @delete-post="deletePost(post.id)"
              @like-post="likePost(post.id)"
              @unlike-post="unlikePost(post.id)"
            />
          </v-tab-item>
          <v-tab-item class="pa-1">
            <post-like-card />
          </v-tab-item>
        </v-tabs-items>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import { mapActions } from 'vuex'
import PostItemCard from '../components/organisms/cards/PostItemCard.vue'
import PostLikeCard from '../components/organisms/cards/PostLikeCard.vue'
import CreatePostModal from '../components/organisms/modals/CreatePostModal.vue'
import EditPostModal from '../components/organisms/modals/EditPostModal.vue'
export default {
  name: 'TimelinePage',
  components: { PostItemCard, PostLikeCard, CreatePostModal, EditPostModal },
  auth: false,
  data() {
    return {
      tab: 'post_list',
      postId: null
    }
  },
  methods: {
    ...mapActions({
      setOpeCreatetPostModal: 'modal/setOpeCreatetPostModal',
      setOpenEditPostModal: 'modal/setOpenEditPostModal',
      delete: 'post/delete',
      like: 'post/like'
    }),
    openEditPostModal(id) {
      this.postId = id
      // モーダルにpropsで渡す
      // モーダルをひらく
      this.setOpenEditPostModal(true)
      // モーダルでid番目のpostを取得して反映させる
    },
    openCreatePostModal() {
      this.setOpeCreatetPostModal(true)
    },
    deletePost(id) {
      this.$postApi
        .delete(id)
        .then((res) => {
          console.log(res)
          // id一回使ってなかったらresでidを返すようにする
          this.delete(id)
          this.$toast.success('記録の削除に成功しました。')
        })
        .catch(() => this.$toast.error('記録の削除に失敗しました。'))
    },
    likePost(id) {
      this.$postApi
        .like(id)
        .then((res) => {
          console.log(res)
          this.like(res.data)
          this.$toast.success('お気に入りにしました。')
        })
        .catch(() => this.$toast.error('お気に入りに失敗しました。'))
    },
    unlikePost(id) {
      this.$postApi
        .unlike(id)
        .then((res) => {
          console.log(res)
          this.unlike(res.data)
          this.$toast.success('お気に入りを解除しました。')
        })
        .catch(() => this.$toast.error('お気に入り解除に失敗しました。'))
    }
  }
}
</script>
