<template>
  <v-card width="400px" class="mx-auto mt-5">
      <v-card-title>
        <h1 class="display-1">パスワードリセット</h1>
      </v-card-title>
      <v-card-text>
        <v-form @submit.prevent="resetPassword">
          <v-text-field
            v-model="form.email"
            :rules="[rules.required, rules.email]"
            prepend-icon="mdi-email-outline"
            label="メールアドレス"
            type="email"
          />
          <v-text-field
            v-model="form.password"
            :rules="[rules.required]"
            prepend-icon="mdi-lock"
            label="パスワード"
            type="password"
           />
          <v-text-field
            v-model="form.password_confirmation"
            :rules="[rules.required]"
            prepend-icon="mdi-lock-check"
            label="パスワード確認用"
            type="password"
           />
          <v-card-actions>
             <v-row
              justify="end"
             >
              <v-btn
                class="info"
                type = "submit"
              >パスワードリセット
              </v-btn>
             </v-row>
          </v-card-actions>
        </v-form>
      </v-card-text>
    </v-card>
</template>

<script>
export default {
  auth: false,
  data() {
    return {
      form: {
        email: this.$route.query.email || "",
        password: "",
        password_confirmation: "",
        token: this.$route.query.token || "",
      },
    };
  },
  methods: {
    async resetPassword() {
      try {
        await this.$axios.get("sanctum/csrf-cookie");
        await this.$axios.post("reset-password", this.form);
      } catch (e) {}
    },
  },
};
</script>
