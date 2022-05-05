<template>
  <div class="">
    <v-row class="d-flex justify-space-around">
      <v-col cols="5">
        <save-amount-ranking />
      </v-col>
      <v-col cols="6">
         <follow-list
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
import FollowList from '../components/organisms/lists/FollowList.vue'
import SaveAmountRanking from '../components/organisms/rankings/SaveAmountRanking.vue'
export default {
  name: 'FollowPage',
  components: { SaveAmountRanking, FollowList },
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
