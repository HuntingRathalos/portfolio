<template>
  <v-text-field
    v-model.number="setTargetAmount"
    :rules="[rules.required, rules.isNum, rules.notZero]"
    label="目標額"
    placeholder="30000"
    type="number"
    outlined
    dense
    rounded
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
