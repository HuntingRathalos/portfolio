<template>
  <ResetPasswordForm />
</template>

<script>
import ResetPasswordForm from '../components/organisms/forms/ResetPasswordForm.vue'
export default {
  name: 'ResetPasswordPage',
  components: { ResetPasswordForm },
  layout: 'auth',
  auth: false
}
</script>
