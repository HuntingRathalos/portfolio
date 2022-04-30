<template>
  <div class="">
    <v-card outlined class="pt-8 mx-auto">
      <v-row>
        <v-col cols="4">
          <v-sheet class="text-center">
            <v-badge
             content="1"
             overlap
             left
             color="yellow darken-1"
            >
                <v-icon x-large>mdi-candy</v-icon>
            </v-badge>
            <div class="text-h6 font-weight-medium">キャンディ</div>
            <div class="text-h6 font-weight-medium">3回</div>
          </v-sheet>
        </v-col>
        <v-col cols="4">
          <v-sheet class="text-center">
            <v-badge
             content="2"
             overlap
             left
             color="blue-grey lighten-2"
            >
                <v-icon x-large>mdi-gift</v-icon>
            </v-badge>
            <div class="text-h6 font-weight-medium">プレゼント</div>
            <div class="text-h6 font-weight-medium">2回</div>
          </v-sheet>
        </v-col>
        <v-col cols="4">
          <v-sheet class="text-center">
            <v-badge
             content="3"
             overlap
             left
             color="brown darken-1"
            >
                <v-icon x-large>mdi-fish</v-icon>
            </v-badge>
            <div class="text-h6 font-weight-medium">食べ物</div>
            <div class="text-h6 font-weight-medium">1回</div>
          </v-sheet>
        </v-col>
      </v-row>
    </v-card>
  </div>
</template>
<script>
export default {

}
</script>
