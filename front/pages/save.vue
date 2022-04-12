<template>
  <div>
    <SaveCalendar/>
    <SaveList />
    <SaveModal />
  </div>
</template>
<script>
import SaveList from '../components/organisms/lists/SaveList.vue'
import SaveModal from '../components/organisms/modals/SaveModal.vue'
import SaveCalendar from '../components/organisms/SaveCalendar.vue'
export default {
  name: 'SavePage',
  components: { SaveModal, SaveCalendar, SaveList },
  methods: {

  }
}
</script>
