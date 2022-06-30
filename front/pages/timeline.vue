<template>
  <v-container>
    <create-post-modal />
    <edit-post-modal :post-id="postEditId" />
    <alert-dialog @runMethod="deletePost" />
    <v-row justify="center">
      <v-col lg="6" sm="8" cols="12">
        <v-tabs
          v-model="tab"
          fixed-tabs
          centered
          background-color="indigo accent-1"
          color="white"
          slider-color="orange"
          icons-and-text
        >
          <v-tab class="ma-0 pa-0" href="#post_list">
            新着順
            <v-icon>mdi-clock-time-eight</v-icon>
          </v-tab>
          <v-tab class="ma-0 pa-0" href="#post_like">
            お気に入り
            <v-icon>mdi-heart-settings</v-icon>
          </v-tab>
        </v-tabs>
        <v-tabs-items v-model="tab">
          <v-tab-item class="pa-1 tab_item overflow-y-auto" value="post_list">
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
              :like-posts-id="likePostsId"
              @openEditPostModal="openEditPostModal(post.id)"
              @deletePost="openAlertModal(post.id)"
            />
          </v-tab-item>
          <v-tab-item class="pa-1" value="post_like">
            <div v-if="likePosts.length !== 0">
              <post-like-card
                v-for="post in likePosts"
                :key="post.id"
                :post="post"
              />
            </div>
            <div v-else style="max-width: 820px" class="mx-auto">
              <v-card flat color="grey lighten-3">
                <v-img
                  class="mx-auto"
                  :src="require('@/assets/Writer block-rafiki.svg')"
                  max-height="350"
                  max-width="400"
                >
                </v-img>
                <p class="text-center">お気に入りした投稿がありません。</p>
                <p class="text-center">お気に入りしてみましょう！</p>
              </v-card>
            </div>
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
import AlertDialog from '../components/organisms/modals/AlertDialog.vue'
import CreatePostModal from '../components/organisms/modals/CreatePostModal.vue'
import EditPostModal from '../components/organisms/modals/EditPostModal.vue'
export default {
  name: 'TimelinePage',
  components: {
    PostItemCard,
    PostLikeCard,
    CreatePostModal,
    EditPostModal,
    AlertDialog
  },
  auth: false,
  data() {
    return {
      tab: 'post_list',
      postEditId: null,
      postDeleteId: null,
      likePostsId: []
    }
  },
  computed: {
    ...mapGetters('post', {
      posts: 'posts',
      likePosts: 'likePosts'
    })
  },
  created() {
    this.$postApi.get().then((res) => {
      this.get(res.data)
    })

    this.$postApi.getLikePosts().then((res) => {
      if (res.data) {
        this.getLiked(res.data)
        const likePostsId = res.data.map((likePost) => likePost.id)
        this.likePostsId = likePostsId
      }
    })
  },
  methods: {
    ...mapActions({
      setOpenCreatePostModal: 'modal/setOpenCreatePostModal',
      setOpenEditPostModal: 'modal/setOpenEditPostModal',
      setOpenAlertModal: 'modal/setOpenAlertModal',
      get: 'post/get',
      getLiked: 'post/getLiked',
      delete: 'post/delete',
      like: 'post/like'
    }),
    openEditPostModal(id) {
      this.postEditId = id
      this.setOpenEditPostModal(true)
    },
    openCreatePostModal() {
      this.setOpenCreatePostModal(true)
    },
    openAlertModal(id) {
      this.postDeleteId = id
      this.setOpenAlertModal(true)
    },
    deletePost() {
      if (this.$guestJudge()) {
        this.$guestAlert()
        return
      }
      this.$postApi
        .delete(this.postDeleteId)
        .then(() => {
          this.delete(this.postDeleteId)
          this.setOpenAlertModal(false)
          this.$toast.success('記録の削除に成功しました。')
        })
        .catch(() => this.$toast.error('記録の削除に失敗しました。'))
    }
  }
}
</script>
<style scoped>
.tab_item {
  max-height: 90vh;
}
</style>
