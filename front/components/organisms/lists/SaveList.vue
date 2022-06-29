<template>
  <div class="list overflow-y-auto">
    <SaveListItem
      v-for="save in saves"
      :key="save.id"
      :save="save"
      margin-class="mb-4"
      @save-edit-id-send="sendSaveEditId"
      @save-delete-id-send="sendSaveDeleteId"
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
  methods: {
    sendSaveEditId(saveId) {
      this.$emit('save-edit-id-send', saveId)
    },
    sendSaveDeleteId(saveId) {
      this.$emit('save-delete-id-send', saveId)
    }
  }
}
</script>
<style scoped>
.list {
  max-height: 400px;
}
</style>
