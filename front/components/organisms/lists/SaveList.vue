<template>
  <div >
    <SaveListItem  v-for="saving in savings" :key="saving.id" :saving="saving" margin-class="mb-4" />
  </div>
</template>
<script>
import SaveListItem from '../../molecules/SaveListItem.vue'

export default {
  components: { SaveListItem },
  data() {
    return {
      flag: false,
      savings: [
        {
          id: 1,
          icon: 'mdi-folder',
          item: 'マンガ',
          amount: '+1000¥',
          date: '2022/1/1',
        },
        {
          id: 2,
          icon: 'mdi-folder',
          item: '本',
          amount: '+1000¥',
          date: '2022/1/2',
        },
      ]
    }
  },
}
</script>
