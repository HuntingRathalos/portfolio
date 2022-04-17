<template>
  <div class="">
    <VueTagsInput
      v-model="inputTag"
      :tags="tags"
      :add-only-from-autocomplete="true"
      :autocomplete-always-open="openAuto"
      :max-tags="1"
      :autocomplete-items="filteredItems"
      placeholder="タグを1つ選択できます。"
      @before-adding-tag="validTag"
      @tags-changed="(newTags) => (tags = newTags)"
    />
    <input type="hidden" name="tags" :value="tagsValue" />
    <div v-if="errorText">{{ errorText }}</div>
  </div>
</template>
<script>
import VueTagsInput from '@johmun/vue-tags-input'
export default {
  components: { VueTagsInput },
  data() {
    return {
      inputTag: '',
      tags: [],
      errorText: '',
      autocompleteItems: [
        {
          text: 'Spain'
        },
        {
          text: 'France'
        },
        {
          text: 'USA'
        },
        {
          text: 'Germany'
        },
        {
          text: 'China'
        }
      ]
    }
  },
  computed: {
    openAuto() {
      if(this.tags.length !== 0) {
        return false
      }
      return true
    },
    filteredItems() {
      return this.autocompleteItems.filter((i) => {
        return (
          i.text.toLowerCase().includes(this.inputTag.toLowerCase()) !== false
        )
      })
    },
    tagsValue() {
      return this.tags.map(function (tag) {
        return tag.text
      })
    }
  },
  methods: {
    validTag(obj) {
      if (obj.tag.text.length > 30) {
        this.errorText = 'タグは30文字以内で入力してください'
      } else {
        this.errorText = ''
        obj.addTag()
      }
    }
  }
}
</script>

<style >
.ti-autocomplete ul {
    overflow-y: scroll;
    max-height: 112px;
  }
</style>
