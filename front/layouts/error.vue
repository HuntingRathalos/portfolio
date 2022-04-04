<template>
  <v-app dark>
    <v-container fill-height>
      <v-row>
        <v-col cols="12">
          <v-card-title class="justify-center">
            {{ status }}
          </v-card-title>
          <v-card-text class="text-center">
            {{ message }}
          </v-card-text>
          <v-card-actions class="justify-center">
            <v-btn
              icon
              x-large
              @click="redirect"
            >
              <v-icon>
                mdi-home
              </v-icon>
            </v-btn>
          </v-card-actions>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>
<script>
export default {
  name: 'EmptyLayout',
  props: {
    error: {
      type: Object,
      default: null
    }
  },
  computed: {
    status () {
      return this.error.statusCode
    },
    message () {
      return this.error.message
    }
  },
  methods: {
    redirect () {
      return this.$route.name === 'index'
        ? this.$router.go() : this.$router.push('/')
    }
  }
}
</script>
