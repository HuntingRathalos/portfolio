<template>
  <v-list-item dense>
    <v-list-item-content>
      <v-list-item-subtitle>{{
        notification.data.content
      }}</v-list-item-subtitle>
    </v-list-item-content>

    <v-list-item-action v-if="activeFlag">
      <div class="ml-auto">
        <v-btn icon text small color="orange">
          <v-icon> mdi-checkbox-marked </v-icon>
        </v-btn>
      </div>
    </v-list-item-action>
    <v-list-item-action v-else>
      <div class="ml-auto">
        <v-btn icon text small color="grey darken-2" @click="checkNotification">
          <v-icon> mdi-checkbox-blank-outline</v-icon>
        </v-btn>
      </div>
    </v-list-item-action>
  </v-list-item>
</template>
<script>
import { mapActions } from 'vuex'
export default {
  props: {
    notification: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      activeFlag: false
    }
  },
  methods: {
    checkNotification() {
      if (this.$guestJudge()) {
        this.$guestAlert()
        return
      }
      this.$notificationApi
        .check(this.notification.id)
        .then(() => {
          this.activeFlag = true
          this.$toast.success('既読をつけました。')
        })
        .catch(() => this.$toast.error('既読をつけられませんでした。'))
    }
  }
}
</script>
