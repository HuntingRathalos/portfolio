<template>
  <v-card max-width="600" class="mx-auto" :class="marginClass">
    <v-list-item @click="sendSaveId">
      <v-list-item-avatar>
        <v-icon class="grey lighten-1" dark>
          {{ iconName }}
        </v-icon>
      </v-list-item-avatar>

      <v-list-item-content>
        <v-list-item-title>{{ tagName }}</v-list-item-title>

        <v-list-item-subtitle>{{ save.click_date }}</v-list-item-subtitle>
      </v-list-item-content>

      <v-list-item-action>
        {{ amount }}
      </v-list-item-action>
    </v-list-item>
  </v-card>
</template>
<script>
export default {
  props: {
    save: {
      type: Object,
      default: null
    },
    marginClass: {
      type: String,
      default: 'mb-0'
    }
  },
  data() {
    return {
      iconNames: [
        'mdi-book-open-variant',
        'mdi-cart-outline',
        'mdi-tshirt-crew-outline',
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
      ],
      tagNames: [
        '外食',
        '飲み会',
        '食品',
        'お酒',
        'タバコ',
        '日用品',
        '趣味',
        '家族',
        '旅行',
        '携帯',
        '交通',
        '交際',
        'スポーツ',
        '本',
        '音楽',
        '水道光熱',
        'ネットショッピング',
        '美容',
        '洋服',
        'その他'
      ]
    }
  },
  computed: {
    iconName() {
      if (this.save !== null) {
        return this.iconNames[this.save.icon_id - 1]
      }
      return 'mdi-fish'
    },
    tagName() {
      if (this.save !== null) {
        return this.tagNames[this.save.tag_id - 1]
      }
      return 'コンビニ'
    },
    amount() {
      if (this.save.coin > 0) {
        return `+${this.save.coin * 500}¥`
      }
      return `${this.save.coin * 500}¥`
    }
  },
  methods: {
    sendSaveId() {
      this.$emit('save-id-send', this.save.id)
    }
  }
}
</script>
