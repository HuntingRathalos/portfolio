<template>
  <div class="">
    <edit-post-modal />
  </div>
</template>
<script>
import EditPostModal from '../components/organisms/modals/EditPostModal.vue'
export default {
  name: 'TimePage',
  components: { EditPostModal },
  auth: false
}
</script>
