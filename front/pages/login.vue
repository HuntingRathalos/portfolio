<template>
  <LoginForm />
</template>

<script>
import LoginForm from '../components/organisms/forms/LoginForm.vue'
export default {
  name: 'LoginPage',
  components: { LoginForm },
  layout: 'auth',
  auth: false,
  middleware: 'afterLoddedInRedirect'
}
</script>
