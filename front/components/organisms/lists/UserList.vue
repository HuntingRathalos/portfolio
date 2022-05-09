<template>
  <v-list subheader two-line>
    <user-list-item
      v-for="user in users"
      :key="user.id"
      :user="user"
      :follow-users-id="followUsersId"
    />
  </v-list>
</template>
<script>
import UserListItem from '../../molecules/listItem/UserListItem.vue'
export default {
  components: { UserListItem },
  data() {
    return {
      users: [],
      followUsersId: []
    }
  },
  created() {
    const users = JSON.parse(sessionStorage.getItem('users'))

    if (users && users !== undefined) {
      this.users = users
    }
    const followUsers = JSON.parse(sessionStorage.getItem('followUsers'))
    if (!followUsers) {
      this.followUsersId = []
    } else {
      const followUsersId = followUsers.map((followUser) => followUser.id)
      this.followUsersId = followUsersId
    }
  }
}
</script>
