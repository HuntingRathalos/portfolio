<template>
    <v-card
    v-ripple
    class="mx-auto"
    :class="marginClass"
    max-width="400"
    @click = "active = !active"
  >
  <v-list-item two-line>
      <v-list-item-content>
        <v-list-item-title class="text-h5">
          {{ user.name }}
        </v-list-item-title>
      </v-list-item-content>
      <v-list-item-action class = "mr-4">
        <v-list-item-action-text></v-list-item-action-text>
        <v-icon
          v-if = "!active"
          color="grey lighten-1"
        >
          mdi-heart
        </v-icon>
        <v-icon
          v-else
          color="red lighten-1"
        >
          mdi-heart
        </v-icon>
      </v-list-item-action>
    </v-list-item>
    <v-list class="transparent" dense>
        <v-list-item
        >
          <v-list-item-title>目標</v-list-item-title>

          <v-list-item-subtitle class="text-center ml-12">
            {{ user.target }}
          </v-list-item-subtitle>
        </v-list-item>
        <v-list-item
        >
          <v-list-item-title>目標金額</v-list-item-title>

          <v-list-item-subtitle class="text-center ml-12">
          {{ user.targetAmount }}
          </v-list-item-subtitle>
        </v-list-item>
        <v-list-item
        >
          <v-list-item-title>最初に我慢したもの</v-list-item-title>

          <v-list-item-subtitle class="text-center ml-12">
            {{ user.tagName }}
          </v-list-item-subtitle>
        </v-list-item>
      </v-list>
  </v-card>
</template>
<script>
export default {
  props: {
    user: {
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
      active : false,
    }
  }
}
</script>
