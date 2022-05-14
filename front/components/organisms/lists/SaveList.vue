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
  methods: {
    sendSaveId(saveId) {
      this.$emit('save-id-send', saveId)
    }
  }
}
</script>
