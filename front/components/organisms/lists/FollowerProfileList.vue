<template>
  <div>
    <v-card class="pl-2 mx-auto" :class="marginClass" :width="cardWidth">
      <v-list-item two-line>
        <v-list-item-content>
          <v-list-item-title class="text-h5">
            {{ followUser.name }}
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list class="transparent" dense>
        <v-list-item>
          <v-list-item-title>目標</v-list-item-title>

          <v-list-item-subtitle class="text-center ml-12">
            {{ followUser.target }}
          </v-list-item-subtitle>
        </v-list-item>
        <v-list-item>
          <v-list-item-title>目標金額</v-list-item-title>

          <v-list-item-subtitle class="text-center ml-12">
            {{ followUser.targetAmount }}
          </v-list-item-subtitle>
        </v-list-item>
        <v-list-item>
          <v-list-item-title>最初に我慢したもの</v-list-item-title>

          <v-list-item-subtitle class="text-center ml-12">
            {{ followUser.tagName }}
          </v-list-item-subtitle>
        </v-list-item>
      </v-list>
    </v-card>
  </div>
</template>
<script>
export default {
  props: {
    followUser: {
      type: Object,
      default: null
    },
    marginClass: {
      type: String,
      default: 'mb-0'
    }
  },
  data() {
    return {}
  },
  computed: {
    cardWidth() {
      const brackPointName = this.$vuetify.breakpoint.name
      if (brackPointName === 'xs') {
        return '340'
      }
      return '400'
    }
  }
}
</script>
