<template>
  <v-text-field
    v-model="setMemo"
    :rules="[rules.maxCount30, rules.required]"
    label="一言メモ"
    prepend-icon="mdi-note-text-outline"
    color="indigo accent-2"
  />
</template>
<script>
export default {
  props: {
    memo: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      rules: {
        required: (value) => !!value || '必須項目なので値を入力してください。',
        maxCount30: (value) =>
          value.length <= 30 || '文字数をオーバーしています。'
      }
    }
  },
  computed: {
    setMemo: {
      get() {
        return this.memo
      },
      set(newVal) {
        return this.$emit('update:memo', newVal)
      }
    }
  }
}
</script>
