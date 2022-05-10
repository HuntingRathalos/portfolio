<template>
  <div class="">
    <follower-profile-list
      v-for="followUser in followUsers"
      :key="followUser.id"
      :follow-user="followUser"
    />
  </div>
</template>
<script>
import FollowerProfileList from '../components/organisms/lists/FollowerProfileList.vue'
export default {
  name: 'FollowerProfile',
  components: { FollowerProfileList },
  data() {
    return {
      followUsers: []
    }
  },
  created() {
    const followUsers = JSON.parse(sessionStorage.getItem('followUsers'))
    this.followUsers = followUsers
  }
}
</script>
