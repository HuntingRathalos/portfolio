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
      @tags-changed="tagsChanged"
    />
    <!-- <input v-if="isTagId" type="hidden" v-on="getTagText()" /> -->
    <!-- <input v-model="tag"  type="hidden" /> -->
    <div v-if="errorText">{{ errorText }}</div>
  </div>
</template>
<script>
import VueTagsInput from '@johmun/vue-tags-input'
export default {
  components: { VueTagsInput },
  props: {
    tagId: {
      type: Number,
      default: null
    }
  },
  data() {
    return {
      inputTag: '',
      tags: [],
      errorText: '',
      autocompleteItems: [
        {
          id: 1,
          text: 'Spain'
        },
        {
          id: 2,
          text: 'France'
        },
        {
          id: 3,
          text: 'USA'
        },
        {
          id: 4,
          text: 'Germany'
        },
        {
          id: 5,
          text: 'China'
        }
      ]
    }
  },
  computed: {
    openAuto() {
      if (this.tags.length !== 0) {
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
    tag: {
      get() {
        return this.tagId
      },
      set(newVal) {
        return this.$emit('update:tagId', newVal)
      }
    },
    isTagId() {
      if (this.tagId === null) {
        return false
      }
      return true
    },
    tagsValue() {
      return this.tags[0] || null
    }
    // setTagId: {
    //   get() {
    //     return this.tagId
    //   },
    //   set(newVal) {
    //     return this.$emit('update:tagId', newVal)
    //   }
    // }
  },
  created() {
    console.log(this.inputTag)
    //   console.log(this.tagId)
    //   if(this.tagId !== null) {
    //       this.tags = []
    //       const tag = this.autocompleteItems.find(
    //         (autocompleteItem) => autocompleteItem.id === this.tagId
    //       )
    //       this.tags.push({text: tag.text})
    //       console.log(this.tags)
    //       if (this.tagsValue !== null) {
    //       const tag = this.autocompleteItems.find(
    //         (autocompleteItem) => autocompleteItem.text === this.tagsValue.text
    //       )
    //       this.$emit('set-tag-id', tag.id)
    //     }
    //       this.tagsChanged({text: tag.text, style: '', classes: ''})
    //     }
  },
  methods: {
    validTag(obj) {
      if (obj.tag.text.length > 30) {
        this.errorText = 'タグは30文字以内で入力してください'
      } else {
        this.errorText = ''
        obj.addTag()
      }
    },
    getTagText() {
      console.log(this.tagId)
      // if(this.tagId !== null) {
      this.tags = []
      const tag = this.autocompleteItems.find(
        (autocompleteItem) => autocompleteItem.id === this.tagId
      )
      this.tags.push({ text: tag.text })
      // this.tagsChanged({text: tag.text})
      //     console.log(this.tags)
      //     if (this.tagsValue !== null) {
      // const newTag = this.autocompleteItems.find(
      //   (autocompleteItem) => autocompleteItem.text === this.tagsValue.text
      // )
      // this.$emit('set-tag-id', newTag.id)
      //   }
      //     this.tagsChanged({text: tag.text, style: '', classes: ''})
      //   }
    },
    tagsChanged(newTag) {
      this.tags = newTag
      // const topTag =this.tags[0] || ''
      // console.log(this.tagsValue)
      if (this.tagsValue !== null) {
        const tag = this.autocompleteItems.find(
          (autocompleteItem) => autocompleteItem.text === this.tagsValue.text
        )
        // console.log(tag)
        this.$emit('set-tag-id', tag.id)
      }
    }
  }
}
</script>

<style>
.ti-autocomplete ul {
  overflow-y: scroll;
  max-height: 112px;
}
</style>
