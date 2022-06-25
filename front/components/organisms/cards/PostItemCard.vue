<template>
  <v-card class="mx-auto" flat>
    <v-card flat class="text-center pt-2">
      <!-- <h2 class="font-weight-medium">pooさん</h2> -->
      <h2 class="font-weight-medium">{{ $auth.user.name }}さん</h2>
      <h4 class="font-weight-medium">{{ post.updated_at }}</h4>
    </v-card>
    <v-card-actions class="mb-2">
      <v-row>
        <v-col cols="12">
          <span class="text-subtitle-1 font-weight-bold text--secondary pl-2"
            >自己評価</span
          >
          <v-row justify="center">
            <v-rating
              background-color="orange lighten-3"
              readonly
              color="orange"
              large
              length="5"
              size="64"
              :value="post.self_evaluation"
            ></v-rating>
          </v-row>
        </v-col>
      </v-row>
    </v-card-actions>
    <v-card-actions>
      <v-row class="mx-auto">
        <v-col cols="12">
          <v-textarea
            autofocus
            readonly
            success
            color="green accent-3"
            label="良かったポイント"
            :value="post.good_description"
            rows="2"
          ></v-textarea>
        </v-col>
      </v-row>
    </v-card-actions>
    <v-card-actions>
      <v-row class="mx-auto">
        <v-col cols="12">
          <v-textarea
            readonly
            error
            color="red accent-2"
            label="わるかったポイント"
            :value="post.bad_description"
            rows="2"
          ></v-textarea>
        </v-col>
      </v-row>
    </v-card-actions>

    <v-card-actions class="ml-auto">
      <div class="ml-auto">
        <v-btn
          icon
          text
          color="grey darken-2"
          @click="$emit('openEditPostModal')"
        >
          <v-icon> mdi-pencil-box-multiple </v-icon>
        </v-btn>
        <v-btn icon text color="grey darken-2" @click="$emit('deletePost')">
          <v-icon> mdi-delete </v-icon>
        </v-btn>
        <v-btn
          v-if="active"
          icon
          text
          color="red lighten-1"
          @click="likePost(post.id)"
        >
          <v-icon> mdi-heart </v-icon>
        </v-btn>
        <v-btn
          v-else
          icon
          text
          color="grey darken-2"
          @click="unlikePost(post.id)"
        >
          <v-icon> mdi-heart </v-icon>
        </v-btn>
      </div>
    </v-card-actions>
    <v-divider></v-divider>
  </v-card>
</template>
<script>
import { mapActions } from 'vuex'
export default {
  props: {
    post: {
      type: Object,
      default: null
    },
    likePostsId: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      active: false
    }
  },
  created() {
    const judge = this.likePostsId.indexOf(this.post.id)
    if (judge !== -1) {
      this.active = true
    }
  },
  methods: {
    ...mapActions({
      like: 'post/like',
      unlike: 'post/unlike'
    }),
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
          this.unlike(id)
          this.$toast.success('お気に入りを解除しました。')
        })
        .catch(() => this.$toast.error('お気に入り解除に失敗しました。'))
    }
  }
}
</script>
