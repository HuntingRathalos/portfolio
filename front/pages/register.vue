<template>
  <v-card width="400px" class="mx-auto mt-5">
      <v-card-title>
        <h1 class="display-1">会員登録</h1>
      </v-card-title>
      <v-card-text>
        <v-form @submit.prevent="signUp">
          <v-text-field
            v-model="form.name"
            :rules="[rules.required]"
            prepend-icon="mdi-account-outline"
            label="名前"
            type="text"
          />
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
              >登録する
              </v-btn>
             </v-row>
          </v-card-actions>
        </v-form>
      </v-card-text>
    </v-card>
</template>

<script>
export default {
  name: 'RegisterPage',
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      rules: {
          required: value => !!value || '必須項目なので値を入力してください。',
          email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || '正しい形式で入力してください。'
          },
        },
    };
  },
  methods: {
    async signUp() {
        await this.$axios.get("/sanctum/csrf-cookie");
       const response = await this.$axios.post("/register", this.form)
        .catch(err => err.response || err)
      if(response.status === 400){
        console.log(response)
      }


    },
  },
};
</script>
