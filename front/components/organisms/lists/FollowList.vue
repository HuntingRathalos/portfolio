<template>
  <v-list
      subheader
      two-line
    >
    <follow-list-item
      v-for="user in users"
      :key="user.id"
      :user="user"
    />
  </v-list>
</template>
<script>
import FollowListItem from '../../molecules/listItem/FollowListItem.vue'
export default {
  components: { FollowListItem },
   data() {
    return {
      active : false,
      users: [
        {
          id:1,
          name: 'poo',
          createdAt:'2022-05-02',
        },
        {
          id: 4,
          name: 'poo',
          createdAt:'2022-05-02',
        },
        {
          id: 5,
          name: 'poo',
          createdAt:'2022-05-02',
        },
      ],
    }
  },
  // conputed: {
  //   isFollowed() {
  //     this.followerNumArray.includes()
  //   }
  // }
}
</script>
