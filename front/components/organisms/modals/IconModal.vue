<template>
  <v-dialog v-model="openIconModal" max-width="250px">
    <template #activator="{ on, attrs }">
      <v-btn block height="24px" v-bind="attrs" v-on="on">
        アイコンを選択する
      </v-btn>
    </template>
    <v-card>
      <v-toolbar class="indigo accent-1" flat>
        <v-toolbar-title class="white--text font-weight-bold">
          アイコン一覧
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-icon dark @click="closeIconModal"> mdi-close </v-icon>
      </v-toolbar>
      <v-sheet
        class="d-flex justify-space-around flex-wrap px-2"
        max-width="250px"
      >
        <single-icon
          v-for="iconCode in iconCodes"
          :key="iconCode.id"
          :icon-code="iconCode"
          margin-class="ma-2"
          @closeIconModal="closeIconModal"
        />
        <!-- <SingleIcon
          v-for="iconCode in iconCodes"
          :key="iconCode.id"
          :icon-code="iconCode"
          margin-class="ma-2"
          @closeIconModal="closeIconModal"
        /> -->
      </v-sheet>
      <v-card-actions class="ml-auto">
        <v-btn
          color="teal accent-3"
          class="white--text ml-auto"
          @click="openIconModal = false"
        >
          閉じる
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import SingleIcon from '../../molecules/icons/SingleIcon.vue'
export default {
  components: { SingleIcon },
  data: () => ({
    openIconModal: false,
    iconCodes: [
      {
        id: 1,
        code: 'mdi-book-open-variant'
      },
      {
        id: 2,
        code: 'mdi-cart-outline'
      },
      {
        id: 3,
        code: 'mdi-tshirt-crew-outline'
      },
      {
        id: 4,
        code: 'mdi-gift'
      },
      {
        id: 5,
        code: 'mdi-coffee-outline'
      },
      {
        id: 6,
        code: 'mdi-hamburger'
      },
      {
        id: 7,
        code: 'mdi-noodles'
      },
      {
        id: 8,
        code: 'mdi-food-apple'
      },
      {
        id: 9,
        code: 'mdi-fish'
      },
      {
        id: 10,
        code: 'mdi-ice-cream'
      },
      {
        id: 11,
        code: 'mdi-candy'
      },
      {
        id: 12,
        code: 'mdi-train-variant'
      },
      {
        id: 13,
        code: 'mdi-ferry'
      },
      {
        id: 14,
        code: 'mdi-taxi'
      },
      {
        id: 15,
        code: 'mdi-bike'
      },
      {
        id: 16,
        code: 'mdi-movie-open'
      },
      {
        id: 17,
        code: 'mdi-music'
      },
      {
        id: 18,
        code: 'mdi-microphone'
      },
      {
        id: 19,
        code: 'mdi-google-controller'
      },
      {
        id: 20,
        code: 'mdi-soccer'
      },
      {
        id: 21,
        code: 'mdi-camera-outline'
      },
      {
        id: 22,
        code: 'mdi-human-male-female-child'
      },
      {
        id: 23,
        code: 'mdi-diamond-stone'
      },
      {
        id: 24,
        code: 'mdi-watch'
      },
      {
        id: 25,
        code: 'mdi-dumbbell'
      }
    ]
  }),
  methods: {
    //   closeIconModal(isopenIconeModal, iconId) {
    //     this.openIconModal = isopenIconeModal
    //     this.$emit('set-icon-id', iconId)
    //   }
    // },
    closeIconModal(isopenIconeModal, iconCode) {
      this.openIconModal = isopenIconeModal
      this.$emit('set-icon-id', iconCode.id)
      this.$emit('set-icon-code', iconCode.code)
    }
  }
}
</script>
