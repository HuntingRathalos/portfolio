<template>
  <v-card width="400px" class="mx-auto mt-5">
      <v-card-title>
        <h1 class="display-1">パスワードリセット</h1>
      </v-card-title>
      <v-card-text>
        <v-form @submit.prevent="sendForgotPasswordEmail">
          <v-text-field
            v-model="form.email"
            :rules="[rules.required, rules.email]"
            prepend-icon="mdi-email-outline"
            label="メールアドレス"
            type="email"
          />
          <v-card-actions>
             <v-row
              justify="end"
             >
              <v-btn
                class="info"
                type = "submit"
              >ログイン
              </v-btn>
             </v-row>
          </v-card-actions>
        </v-form>
      </v-card-text>
    </v-card>
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: "",
      },
    };
  },
  methods: {
    async sendForgotPasswordEmail() {
        await this.$axios.get("sanctum/csrf-cookie");
        const response = await this.$axios.post("forgot-password", this.form)
        .then(console.log())
        .catch(err => err.response || err)

        if(response.status === 400){
        console.log(response)
      }
    },
  },
};
</script>
