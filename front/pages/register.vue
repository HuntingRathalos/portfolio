<template>
  <RegisterForm />
</template>

<script>
import RegisterForm from '../components/organisms/forms/RegisterForm.vue'
export default {
  name: 'RegisterPage',
  auth: false,
  components: { RegisterForm }
}
</script>
