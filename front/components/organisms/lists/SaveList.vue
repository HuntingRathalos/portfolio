<template>
  <div>
    <SaveListItem
      v-for="save in saves"
      :key="save.id"
      :save="save"
      margin-class="mb-4"
      @save-id-send="sendSaveId"
    />
  </div>
</template>
<script>
import SaveListItem from '../../molecules/SaveListItem.vue'

export default {
  components: { SaveListItem },
  props: {
    saves: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      // flag: false,
      // saves: [
      //   {
      //     id: 1,
      //     icon: 'mdi-folder',
      //     item: 'マンガ',
      //     amount: '+1000¥',
      //     date: '2022/1/1'
      //   },
      // ]
    }
  },
  methods: {
    sendSaveId(saveId) {
      // console.log(saveId)
      this.$emit('save-id-send', saveId)
    }
  }
}
</script>
