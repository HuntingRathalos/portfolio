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
          background-color="indigo accent-1"
          color="white"
          slider-color="teal accent-3"
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
          <v-tab-item class="pa-1" value="post_list">
            <v-col cols="12">
              <v-btn
                block
                color="orange"
                dark
                rounded
                @click="openCreatePostModal"
              >
                新しく振り返りを追加する
              </v-btn>
            </v-col>
            <post-item-card
              v-for="post in posts"
              :key="post.id"
              :post="post"
              :like-posst-id="likePostId"
              @openEditPostModal="openEditPostModal(post.id)"
              @deletePost="deletePost(post.id)"
              @likePost="likePost(post.id)"
              @unlikePost="unlikePost(post.id)"
            />
          </v-tab-item>
          <v-tab-item class="pa-1">
            <post-like-card
              v-for="post in likePosts"
              :key="post.id"
              :like-post="post"
            />
          </v-tab-item>
        </v-tabs-items>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
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
      postId: null,
      likePostsId: []
    }
  },
  computed: {
    ...mapGetters('post', {
      posts: 'posts',
      likePosts: 'likePosts'
    })
  },
  // created() {
  //   const posts = this.$postApi.get()
  //   this.get(posts)

  //   const likePosts = this.$postApi.getLikePosts()

  //   if(likePosts) {
  //     this.getLiked(likePosts)
  //     storeに格納する前にID配列を作る
  //     const likePostsId = likePosts.map((likePost) => likePost.id)
  //     this.likePostsId = likePostsId
  //   }
  // },
  methods: {
    ...mapActions({
      setOpenCreatePostModal: 'modal/setOpenCreatePostModal',
      setOpenEditPostModal: 'modal/setOpenEditPostModal',
      get: 'post/get',
      getLiked: 'post/getLiked',
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
      this.setOpenCreatePostModal(true)
    },
    deletePost(id) {
      this.$postApi
        .delete(id)
        .then((res) => {
          this.delete(id)
          this.$toast.success('記録の削除に成功しました。')
        })
        .catch(() => this.$toast.error('記録の削除に失敗しました。'))
    }
  }
}
</script>
