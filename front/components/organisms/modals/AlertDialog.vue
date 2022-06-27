<template>
  <v-dialog v-model="isOpenAlertModal" max-width="500px" persistent>
    <v-card>
      <v-toolbar class="indigo accent-1" flat>
        <v-toolbar-title class="white--text font-weight-bold">
          <!-- 投稿を削除しますか？ -->
          <slot name="titleText">本当に削除しますか?</slot>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-icon dark @click="closeAlertModal"> mdi-close </v-icon>
      </v-toolbar>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12">
              <slot name="btnText" class="text-h3"
                >この操作は取り消せません。投稿が削除されます。</slot
              >
              <!-- <h3>この操作は取り消せません。投稿が削除されます。</h3> -->
            </v-col>
            <v-col cols="12">
              <v-row justify="center">
                <v-btn color="white--text red" @click="$emit('runMethod')"
                  >削除
                </v-btn>
              </v-row>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>
<script>
import { mapActions } from 'vuex'
export default {
  computed: {
    isOpenAlertModal: {
      get() {
        return this.$store.getters['modal/openAlertModal']
      },
      set(newVal) {
        this.$store.dispatch('modal/setOpenAlertModal', newVal)
      }
    }
  },
  methods: {
    closeAlertModal() {
      this.$store.dispatch('modal/setOpenAlertModal', false)
    }
  }
}
</script>
