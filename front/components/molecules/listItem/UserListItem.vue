<template>
  <v-list-item @click="followOrUnfollow">
    <v-list-item-avatar>
      <v-icon class="deep-purple lighten-3">mdi-account</v-icon>
    </v-list-item-avatar>

    <v-list-item-content>
      <v-list-item-title v-text="user.name"></v-list-item-title>

      <v-list-item-subtitle>{{ user.createdAt }}から利用</v-list-item-subtitle>
    </v-list-item-content>

    <v-list-item-action class="mr-4">
      <v-list-item-action-text></v-list-item-action-text>
      <v-icon v-if="!active" color="gray lighten-1"> mdi-heart </v-icon>
      <v-icon v-else color="red lighten-1"> mdi-heart </v-icon>
    </v-list-item-action>
  </v-list-item>
</template>
<script>
export default {
  props: {
    user: {
      type: Object,
      required: true
    },
    followUsersId: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      active: false,
      followUsers: []
    }
  },
  created() {
    const judge = this.followUsersId.indexOf(this.user.id)
    if (judge !== -1) {
      this.active = true
    }
    this.followUsers = JSON.parse(sessionStorage.getItem('followUsers'))
  },
  methods: {
    followOrUnfollow() {
      if (this.$guestJudge()) {
        this.$guestAlert()
        return
      }
      if (this.active === false) {
        this.$userApi
          .follow(this.user.id)
          .then((res) => {
            this.followUsers.push(res.data)
            sessionStorage.setItem(
              'followUsers',
              JSON.stringify(this.followUsers)
            )
            this.active = true
            this.$toast.success(`${this.user.name}さんをフォローしました。`)
          })
          .catch(() => this.$toast.error('フォローに失敗しました。'))
      } else {
        this.$userApi
          .unfollow(this.user.id)
          .then(() => {
            this.followUsers = this.followUsers.filter(
              (followUser) => followUser.id !== this.user.id
            )
            sessionStorage.setItem(
              'followUsers',
              JSON.stringify(this.followUsers)
            )
            this.active = false
            this.$toast.success(`${this.user.name}さんのフォローを外しました。`)
          })
          .catch(() => this.$toast.error('フォローを外すことに失敗しました。'))
      }
    }
  }
}
</script>
