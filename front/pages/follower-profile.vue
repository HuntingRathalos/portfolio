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
    <div :class="flexClass" style="max-width: 820px">
      <follower-profile-list
        v-for="followUser in filteredFollowUsers"
        :key="followUser.id"
        :follow-user="followUser"
        margin-class="mb-4"
      />
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
