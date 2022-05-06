<template>
  <v-list-item
        @click = "active = !active"
      >
        <v-list-item-avatar>
          <v-icon
            class="grey lighten-1"
            dark
          >
            mdi-account
          </v-icon>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title v-text="user.name"></v-list-item-title>

          <v-list-item-subtitle>{{ user.createdAt }}から利用しています。</v-list-item-subtitle>
        </v-list-item-content>

        <v-list-item-action class = "mr-4">
        <v-list-item-action-text></v-list-item-action-text>
        <v-icon
          v-if = "!active"
          color="gray lighten-1"
        >
          mdi-heart
        </v-icon>
        <v-icon
          v-else
          color="red lighten-1"
        >
          mdi-heart
        </v-icon>
      </v-list-item-action>
      </v-list-item>

</template>
<script>
export default {
  props: {
    user: {
      type: Object,
      required: true
    }
  },
   data() {
    return {
      active : false,
      followerNumArray: [1, 2, 3]
    }
  },
  mounted() {
      const judge = this.followerNumArray.indexOf(this.user.id)
      if(judge !== -1) {
        this.active = true
    }
  }
}
</script>
