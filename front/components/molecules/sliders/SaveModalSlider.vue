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
      <v-icon :color="color" @click="decrement"> mdi-minus </v-icon>
    </template>
    <template #append>
      <v-icon :color="color" @click="increment"> mdi-plus </v-icon>
    </template>
  </v-slider>
</template>
<script>
export default {
  props: {
    coin: {
      type: Number,
      default: 0
    }
  },
  data() {
    return {
      rules: {
        notZero: (value) =>
          value !== 0 || '必須項目なので値を入力してください。'
      }
    }
  },
  computed: {
    color() {
      if (this.coin < 0) return 'red'
      if (this.coin === 0) return 'grey'
      return 'blue'
    },
    setCoin: {
      get() {
        return this.coin
      },
      set(newVal) {
        return this.$emit('update:coin', newVal)
      }
    }
  },
  methods: {
    increment() {
      this.$emit('increment')
    },
    decrement() {
      this.$emit('decrement')
    }
  }
}
</script>
