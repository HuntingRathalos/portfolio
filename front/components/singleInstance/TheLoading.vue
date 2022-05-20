<template>
  <div v-if="isLoading" class="loader-background">
    <v-progress-circular
      class="loading"
      :size="loadingSize"
      :width="loadingWidth"
      :indeterminate="isLoading"
    ></v-progress-circular>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  name: 'TheLoading',
  data() {
    return {
      loadingSize: '90',
      loadingWidth: '5'
    }
  },
  computed: {
    ...mapGetters({
      isLoading: 'loading/isLoading'
    })
  }
}
</script>
<style scoped>
.loader-background {
  z-index: 99;
  position: fixed;
  background: #0a0a0a;
  opacity: 0.4;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.loading {
  color: #ffffff;
}
</style>
