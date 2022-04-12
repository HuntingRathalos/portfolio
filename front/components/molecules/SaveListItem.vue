<template>
  <v-card
    max-width="600"
    class="mx-auto"
    :class="marginClass"
  >
    <v-list-item
    >
      <v-list-item-avatar>
        <v-icon
          class="grey lighten-1"
          dark
        >
          {{ saving.icon }}
        </v-icon>
      </v-list-item-avatar>

      <v-list-item-content>
        <v-list-item-title >{{ saving.item }}</v-list-item-title>

        <v-list-item-subtitle >{{ saving.date }}</v-list-item-subtitle>
      </v-list-item-content>

      <v-list-item-action>
        {{ saving.amount }}
      </v-list-item-action>
    </v-list-item>
  </v-card>
</template>
<script>
export default {
  props: {
    saving: {
      type: Object,
      required: true
    },
    marginClass: {
      type: String,
      default: 'mb-0'
    }
  }
}
</script>
