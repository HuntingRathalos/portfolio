<template>
  <v-dialog v-model="isOpenAlertModal" max-width="300px">
    <v-card>
      <v-card-title>
        <div class="text-center">
          <h1 class="text-h5 font-weight-medium" style="width: 100%">
            <slot name="titleText">本当に削除しますか?</slot>
          </h1>
        </div>
      </v-card-title>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="closeAlertModal">
          閉じる
        </v-btn>
        <v-btn color="blue darken-1" text @click="$emit('runMethod')">
          <slot name="btnText">削除</slot>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
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
