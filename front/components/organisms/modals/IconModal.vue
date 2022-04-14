<template>
  <v-dialog v-model="dialog2" max-width="250px">
    <template #activator="{ on, attrs }">
      <v-btn block height="24px" v-bind="attrs" v-on="on">
        アイコンを選択する
      </v-btn>
    </template>
    <v-card>
      <v-card-title> アイコン一覧 </v-card-title>
      <v-sheet
        class="d-flex justify-space-around flex-wrap px-2"
        max-width="250px"
      >
        <SingleIcon
          v-for="iconCode in iconCodes"
          :key="iconCode"
          :icon-code="iconCode"
          margin-class="ma-2"
          @closeIconModal="($event) => (dialog2 = $event)"
        />
      </v-sheet>
      <v-card-actions>
        <v-btn color="primary" text @click="dialog2 = false"> 閉じる </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import SingleIcon from '../../molecules/icons/SingleIcon.vue'
export default {
  components: { SingleIcon },
  data: () => ({
    dialog2: false,
    iconCodes: [
      'mdi-book-open-variant',
      'mdi-cart-outline',
      'mdi-tshirt-crew-outline',
      'mdi-gift',
      'mdi-coffee-outline',
      'mdi-hamburger',
      'mdi-noodles',
      'mdi-food-apple',
      'mdi-fish',
      'mdi-ice-cream',
      'mdi-candy',
      'mdi-train-variant',
      'mdi-ferry',
      'mdi-taxi',
      'mdi-bike',
      'mdi-movie-open',
      'mdi-music',
      'mdi-microphone',
      'mdi-google-controller',
      'mdi-soccer',
      'mdi-camera-outline',
      'mdi-human-male-female-child',
      'mdi-diamond-stone',
      'mdi-watch',
      'mdi-dumbbell'
    ]
  })
}
</script>
