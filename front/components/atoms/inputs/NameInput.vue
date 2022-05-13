<template>
  <v-text-field
    v-model="setName"
    :rules="[rules.required, rules.maxCount255]"
    label="名前"
    placeholder="山田太郎"
    type="text"
    outlined
    dense
    rounded
  />
</template>
<script>
export default {
  props: {
    name: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      rules: {
        required: (value) => !!value || '必須項目なので値を入力してください。',
        maxCount255: (value) =>
          value.length <= 255 || '文字数をオーバーしています。'
      }
    }
  },
  computed: {
    setName: {
      get() {
        return this.name
      },
      set(newVal) {
        return this.$emit('update:name', newVal)
      }
    }
  }
}
</script>
