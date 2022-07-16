<template>
  <v-card class="mx-auto" flat>
    <v-card flat class="text-center pt-2">
      <h2 class="font-weight-medium">{{ post.name }}さん</h2>
      <h4 class="font-weight-medium">{{ post.updated_at }}</h4>
    </v-card>
    <v-card-actions class="mb-2">
      <v-row>
        <v-col cols="12">
          <span class="text-subtitle-1 font-weight-bold text--secondary pl-2"
            >自己評価</span
          >
          <v-row justify="center">
            <v-rating
              background-color="orange lighten-3"
              readonly
              color="orange"
              large
              length="5"
              size="64"
              :value="post.self_evaluation"
            ></v-rating>
          </v-row>
        </v-col>
      </v-row>
    </v-card-actions>
    <v-card-actions>
      <v-row class="mx-auto">
        <v-col cols="12">
          <v-textarea
            readonly
            success
            color="green accent-3"
            label="良かったポイント"
            :value="post.good_description"
            rows="3"
          ></v-textarea>
        </v-col>
      </v-row>
    </v-card-actions>
    <v-card-actions>
      <v-row class="mx-auto">
        <v-col cols="12">
          <v-textarea
            readonly
            error
            color="red accent-2"
            label="わるかったポイント"
            :value="post.bad_description"
            rows="3"
          ></v-textarea>
        </v-col>
      </v-row>
    </v-card-actions>

    <v-divider></v-divider>
  </v-card>
</template>
<script>
export default {
  props: {
    post: {
      type: Object,
      default: null
    }
  }
}
</script>
