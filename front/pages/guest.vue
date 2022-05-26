<template>
  <guest-login-form />
</template>

<script>
import GuestLoginForm from '../components/organisms/forms/GuestLoginForm.vue'
export default {
  name: 'GuestLoginPage',
  components: { GuestLoginForm },
  auth: false,
  middleware: 'afterLoddedInRedirect'
}
</script>
