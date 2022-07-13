<template>
  <v-list-item>
    <v-checkbox
      v-model="isChecked"
      label="既読をつける"
      color="orange"
      value="orange"
      hide-details
      @click="checkOrUncheck"
    ></v-checkbox>

    <v-list-item-content>
      <v-list-item-title
        v-text="notification.read_at"
      ></v-list-item-title>

      <v-list-item-subtitle>{{
        notification.data.content
      }}</v-list-item-subtitle>
    </v-list-item-content>

    <v-list-item-action class="mr-4">
      <v-icon color="gray lighten-1" @click="$emit('deleteNotification')">
        mdi-delete
      </v-icon>
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
      isChecked: false
    }
  },
  created() {
    // まだわかんない
    if (this.notification.read_at) {
      this.isChecked = true
    }
  },
  methods: {
    ...mapActions({
      check: 'notification/check'
      // uncheck: 'notification/uncheck'
    }),
    checkOrUncheck() {
      if (this.$guestJudge()) {
        this.$guestAlert()
        return
      }
      if (this.isChecked === false) {
        this.$notificationApi
          .check(this.notification.id)
          .then((res) => {
            console.log(res)
            this.check(res.data)
            this.$toast.success('既読をつけました。')
          })
          .catch(() => this.$toast.error('既読をつけられませんでした。'))
      } else {
        // this.$notificationApi.uncheck(this.notification.id).then(() => {
        //   this.uncheck()
        //   this.$toast.success('既読を外しました。')
        // })
        // .catch(() => this.$toast.error('既読を外せませんでした。'))
      }
    }
  }
}
</script>
