<template>
  <div class="">
    <ul>
    <li
      v-for="post in posts"
      :key="post.id"
      @click="closeModal(post.id)"
    >
      {{ item.name }}
    </li>
</ul>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
  name: 'TimelinePage',
  data() {
    return {
      postId: '',
    }
  },
    computed: {
    ...mapGetters({
      posts: 'post/posts'
    })
  },
  methods: {
     ...mapActions({
      createPost: 'post/createPost'
    }),
    closeModal(id) {
      console.log(id)
      this.postId = id
      console.log(this.postId)
      this.createPost(this.postId)
    }
  }
}
</script>
