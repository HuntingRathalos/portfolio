<template>
  <v-container>
    <alert-dialog @runMethod="deleteNotification" />
    <v-card max-width="500" class="mx-auto">
      <v-list subheader two-line class="pa-0" outlined>
        <v-toolbar class="indigo accent-1" flat dense>
          <v-toolbar-title class="white--text text-subtitle-2 font-weight-bold">
            あなた宛に届いた通知
          </v-toolbar-title>
        </v-toolbar>
        <div v-if="notifications.length !== 0">
          <notification-list-item

            v-for="notification in notifications"
            :key="notification.id"
            :notification="notification"
            @deleteNotification="openAlertModal(notification.id)"
          />
        </div>
        <div v-else style="max-width: 500px" class="mx-auto">
            <v-card flat>
              <v-img
                class="mx-auto"
                :src="require('@/assets/No data-rafiki.svg')"
                max-height="350"
                max-width="400"
              >
              </v-img>
              <p class="text-center">通知はまだありません。</p>
            </v-card>
          </div>
      </v-list>
    </v-card>
  </v-container>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
import NotificationListItem from '../components/molecules/listItem/NotificationListItem.vue'
import AlertDialog from '../components/organisms/modals/AlertDialog.vue'
export default {
  name: 'NotificationPage',
  components: { NotificationListItem, AlertDialog },
  data() {
    return {
      notificationDeleteId: null
    }
  },
  computed: {
    ...mapGetters('notification', {
      notifications: 'notifications'
    })
  },
  created() {
    this.$notificationApi.get().then((res) => {
      console.log(res)
      this.get(res.data)
    })
  },
  methods: {
    ...mapActions({
      get: 'notification/get',
      delete: 'notification/delete',
      setOpenAlertModal: 'modal/setOpenAlertModal'
    }),
    openAlertModal(id) {
      this.notificationDeleteId = id
      this.setOpenAlertModal(true)
    },
    deleteNotification() {
      this.$notificationApi
        .delete(this.notification.id)
        .then(() => {
          this.delete(this.notificationDeleteId)
          this.setOpenAlertModal(false)
          this.$toast.success('通知を削除しました。')
        })
        .catch(() => this.$toast.error('通知の削除に失敗しました。'))
    }
  }
}
</script>
