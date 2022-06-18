<template>
  <v-row justify="center">
    <v-col lg="6" sm="8" cols="12">
      <v-tabs
        v-model="tab"
        fixed-tabs
        centered
        background-color="cyan darken-1"
        color="white"
        slider-color="orange"
        icons-and-text
      >
        <v-tab class="ma-0 pa-0" href="#tab-1">
          新着順
          <v-icon>mdi-clock-time-eight</v-icon>
        </v-tab>
        <v-tab class="ma-0 pa-0" href="#tab-2">
          いいね
          <v-icon>mdi-clock-time-eight</v-icon>
        </v-tab>
      </v-tabs>
      <v-tabs-items v-model="tab">
        <v-tab-item v-for="i in 3" :key="i" :value="'tab-' + i" class="pa-1">
          <v-card class="mx-auto" flat>
            <v-card flat class="text-center pt-2">
              <h2 class="font-weight-medium">pooさん</h2>
              <h4 class="font-weight-medium">2022年06183時23分</h4>
            </v-card>
            <v-card-actions class="mb-2">
              <v-row>
                <v-col cols="12">
                  <span
                    class="text-subtitle-1 font-weight-bold text--secondary pl-2"
                    >自己評価</span
                  >
                  <v-row justify="center">
                    <v-rating
                      background-color="orange lighten-3"
                      color="orange"
                      large
                      length="5"
                      size="64"
                    ></v-rating>
                  </v-row>
                </v-col>
              </v-row>
            </v-card-actions>
            <v-card-actions>
              <v-row class="mx-auto">
                <v-col cols="12">
                  <v-textarea
                    autofocus
                    readonly
                    success
                    color="green accent-3"
                    label="良かったポイント"
                    value="お菓子を我慢できた"
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
                    value="お菓子を我慢できなかった"
                    rows="3"
                  ></v-textarea>
                </v-col>
              </v-row>
            </v-card-actions>

            <v-card-actions class="ml-auto">
              <div class="ml-auto">
                <v-btn icon text color="grey darken-2">
                  <v-icon> mdi-pencil-box-multiple </v-icon>
                </v-btn>
                <v-btn icon text color="grey darken-2">
                  <v-icon> mdi-delete </v-icon>
                </v-btn>
                <v-btn icon text color="grey darken-2">
                  <v-icon> mdi-heart </v-icon>
                </v-btn>
              </div>
            </v-card-actions>
            <v-divider></v-divider>
          </v-card>
        </v-tab-item>
      </v-tabs-items>
    </v-col>
  </v-row>
</template>
<script>
export default {
  name: 'AaaList',
  auth: false,
  data() {
    return {
      tab: null
    }
  }
}
</script>
