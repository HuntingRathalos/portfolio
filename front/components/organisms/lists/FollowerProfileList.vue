<template>
  <v-card v-ripple class="mx-auto" max-width="400">
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
</template>
<script>
export default {
  props: {
    followUser: {
      type: Object,
      default: null
    }
  },
  data() {
    return {}
  }
}
</script>
