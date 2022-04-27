<template>
  <v-select
    v-model="setTagId"
    :items="items"
    item-text="tagName"
    item-value="id"
    label="タグ"
    prepend-icon="mdi-tag"
  ></v-select>
</template>
<script>
export default {
  props: {
    tagId: {
      type: Number,
      default: 20
    }
  },
  data: () => ({
    // items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
    items: [
      { tagName: '外食', id: 1 },
      { tagName: '飲み会', id: 2 },
      { tagName: '食品', id: 3 },
      { tagName: 'お酒', id: 4 },
      { tagName: 'タバコ', id: 5 },
      { tagName: '日用品', id: 6 },
      { tagName: '趣味', id: 7 },
      { tagName: '家族', id: 8 },
      { tagName: '旅行', id: 9 },
      { tagName: '携帯', id: 10 },
      { tagName: '交通', id: 11 },
      { tagName: '交際', id: 12 },
      { tagName: 'スポーツ', id: 13 },
      { tagName: '本', id: 14 },
      { tagName: '音楽', id: 15 },
      { tagName: '水道光熱', id: 16 },
      { tagName: 'ネットショッピング', id: 17 },
      { tagName: '美容', id: 18 },
      { tagName: '洋服', id: 19 },
      { tagName: 'その他', id: 20 }
    ]
  }),
  computed: {
    setTagId: {
      get() {
        return this.tagId
      },
      set(newVal) {
        return this.$emit('update:tagId', newVal)
      }
    }
  }
}
</script>
