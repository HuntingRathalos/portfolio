<template>
  <div class="">
    <v-row class="d-flex justify-space-around">
      <v-col cols="5">
        <follow-list />
      </v-col>
      <v-col cols="6">
        <follower-profile-list
          v-for="user in users"
          :key="user.id"
          :user="user"
          margin-class="mb-4"
        />
      </v-col>
    </v-row>
  </div>
</template>
<script>
import FollowerProfileList from '../components/organisms/lists/FollowerProfileList.vue'
import FollowList from '../components/organisms/lists/FollowList.vue'
export default {
  name: 'FollowPage',
  components: {  FollowerProfileList, FollowList },
  data() {
    return {
      users: [
        {
          name: 'poo',
          target:'aaa',
          targetAmount:3000,
          tagName: 'sake'
        },
        {
          name: 'poo',
          target:'aaa',
          targetAmount:3000,
          tagName: 'sake'
        },
      ],
    }
  }
}
</script>
