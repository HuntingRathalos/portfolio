<template>
  <v-text-field
    v-model="setTargetName"
    :rules="[rules.required, rules.maxCount50]"
    label="目標"
    placeholder="旅行"
    type="text"
    outlined
    dense
    rounded
  />
</template>
<script>
export default {
  props: {
    targetName: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      rules: {
        required: (value) => !!value || '必須項目なので値を入力してください。',
        maxCount50: (value) =>
          value.length <= 50 || '文字数をオーバーしています。'
      }
    }
  },
  computed: {
    setTargetName: {
      get() {
        return this.targetName
      },
      set(newVal) {
        return this.$emit('update:targetName', newVal)
      }
    }
  }
}
</script>
