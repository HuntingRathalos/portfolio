<template>
  <div>
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
    <div class="text-right">
      <v-btn to="/follower-profile" text color="blue" nuxt class="ml-auto">
        フォローユーザーのプロフィールへ
        <v-icon> mdi-chevron-right </v-icon>
      </v-btn>
    </div>
    <v-card max-width="800" class="mx-auto">
      <v-list subheader two-line class="pa-0" outlined>
        <v-subheader> ユーザーリスト </v-subheader>
        <user-list-item
          v-for="user in filteredUsers"
          :key="user.id"
          :user="user"
          :follow-users-id="followUsersId"
        />
      </v-list>
    </v-card>
  </div>
</template>
<script>
import UserListItem from '../../molecules/listItem/UserListItem.vue'
export default {
  components: { UserListItem },
  data() {
    return {
      keyword: '',
      users: [],
      followUsersId: []
    }
  },
  computed: {
    filteredUsers() {
      const users = this.users.filter(
        (user) => user.name.includes(this.keyword) !== false
      )
      return users
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
