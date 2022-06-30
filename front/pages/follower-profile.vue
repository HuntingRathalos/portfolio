<template>
  <div class="">
    <div style="max-width: 400px" class="mx-auto">
      <v-text-field
        v-model="keyword"
        color="indigo accent-2"
        prepend-icon="mdi-magnify"
        placeholder="ユーザー名を入力"
        solo
        outlined
        dense
        rounded
      />
    </div>
    <div class="text-left">
      <v-btn to="/users" text color="blue" nuxt class="mr-auto">
        <v-icon> mdi-chevron-left </v-icon>
        ユーザー一覧へ
      </v-btn>
    </div>
    <div v-if="isFollowUsers" :class="flexClass" style="max-width: 820px">
      <follower-profile-list
        v-for="followUser in filteredFollowUsers"
        :key="followUser.id"
        :follow-user="followUser"
        margin-class="mb-4"
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
        <p class="text-center">まだ誰もフォローしていません。</p>
        <p class="text-center">フォローしてみましょう！</p>
      </v-card>
    </div>
  </div>
</template>
<script>
import FollowerProfileList from '../components/organisms/lists/FollowerProfileList.vue'
export default {
  name: 'FollowerProfile',
  components: { FollowerProfileList },
  data() {
    return {
      keyword: '',
      followUsers: []
    }
  },
  computed: {
    isFollowUsers() {
      if (this.followUsers.length === 0) {
        return false
      }
      return true
    },
    filteredFollowUsers() {
      const followUsers = this.followUsers.filter(
        (followUser) => followUser.name.includes(this.keyword) !== false
      )
      return followUsers
    },
    flexClass() {
      const brackPointName = this.$vuetify.breakpoint.name
      if (brackPointName === 'xs' || brackPointName === 'sm') {
        return ''
      }
      return 'd-flex justify-space-around flex-wrap mx-auto'
    }
  },
  created() {
    const followUsers = JSON.parse(sessionStorage.getItem('followUsers'))
    this.followUsers = followUsers
  }
}
</script>
