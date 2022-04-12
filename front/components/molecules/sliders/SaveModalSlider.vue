<template>
  <v-slider
    v-model="setCoin"
    :rules="[rules.notZero]"
    :color="color"
    track-color="grey"
    always-dirty
    min="-20"
    max="20"
  >
    <template #prepend>
      <v-icon
        :color="color"
        @click="$store.dispatch('save/decrementCoin')"
      >
        mdi-minus
      </v-icon>
    </template>
    <template #append>
      <v-icon
        :color="color"
        @click="$store.dispatch('save/incrementCoin')"
      >
        mdi-plus
      </v-icon>
    </template>
  </v-slider>
</template>
<script>
export default {
  data() {
    return {
      rules: {
        notZero: (value) => value !== 0 || '必須項目なので値を入力してください。',
      }
    }
  },
  computed: {
    color (){
      if (this.$store.getters['save/coins'] < 0) return 'red'
      if (this.$store.getters['save/coins'] === 0) return 'grey'
      return 'blue'
    },
    setCoin: {
      get() {
        return this.$store.getters['save/coins']
      },
      set(newVal) {
        this.$store.dispatch('save/setCoin', newVal)
      }
    }
  }
}
</script>
