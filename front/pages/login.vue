<template>
  <LoginForm />
</template>

<script>
import LoginForm from '../components/organisms/forms/LoginForm.vue'
export default {
  name: 'LoginPage',
  auth: false,
  components: { LoginForm }
}
</script>
