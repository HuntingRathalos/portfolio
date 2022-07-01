<template>
  <ForgotPasswordForm />
</template>

<script>
import ForgotPasswordForm from '../components/organisms/forms/ForgotPasswordForm.vue'
export default {
  name: 'ForgotPasswordPage',
  components: { ForgotPasswordForm },
  layout: 'auth',
  auth: false
}
</script>
