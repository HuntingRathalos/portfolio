<template>
   <v-card
    class="mx-auto"
    max-width="300"
    tile
  >
    <v-list height = "50">
      <v-list-item link>
        <v-list-item-content>
          <v-list-item-title class="text-h6">
            合計貯金額ランキング
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
    <v-list dense disabled>
      <!-- <v-subheader>連続貯金日数ランキング</v-subheader> -->
      <v-list-item-group
        color="primary"
      >
        <v-list-item
          v-for="item in items"
          :key="item.color"
        >
          <v-list-item-icon>
            <v-icon :color = "item.color" v-text="item.icon"></v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title v-text="item.name"></v-list-item-title>
          </v-list-item-content>
          <v-list-item-action>{{ item.saveAmount }}</v-list-item-action>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-card>
</template>
<script>
export default {
  data() {
    return {
      items: [
        { icon: 'mdi-numeric-1-circle', color: 'yellow darken-1'},
        { icon: 'mdi-numeric-2-circle', color: 'blue-grey lighten-2',},
        { icon: 'mdi-numeric-3-circle', color: 'brown darken-1'},
      ],
    }
  }
}
</script>
