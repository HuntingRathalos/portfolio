<template>
  <v-text-field
    v-model.number="setTargetAmount"
    :rules="[rules.required, rules.isNum, rules.notZero]"
    prepend-icon="mdi-cash-multiple"
    label="目標額"
    type="number"
  />
</template>
<script>
export default {
  props: {
    targetAmount: {
      type: [Number, String],
      default: null
    }
  },
  data() {
    return {
      rules: {
        required: (value) => !!value || '必須項目なので値を入力してください。',
        // 数値バリデーションつける
        email: (value) => {
          const pattern =
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || '正しい形式で入力してください。'
        },
        isNum: (value) => {
          const pattern = /^([1-9]\d*|0)$/
          return pattern.test(value) || '数値を入力してください。'
        },
        notZero: (value) => value !== 0 || '0より大きい値を入力してください。'
      }
    }
  },
  computed: {
    setTargetAmount: {
      get() {
        return this.targetAmount
      },
      set(newVal) {
        return this.$emit('update:targetAmount', newVal)
      }
    }
  }
}
</script>
