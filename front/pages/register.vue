<template>
  <RegisterForm />
</template>

<script>
import RegisterForm from '../components/organisms/forms/RegisterForm.vue'
export default {
  name: 'RegisterPage',
  components: { RegisterForm },
  auth: false,
  layout: 'auth',
  middleware: 'afterLoddedInRedirect'
}
</script>
