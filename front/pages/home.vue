<template>
  <div class="">
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card-title>目標 旅行</v-card-title>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="6">
        <SimpleCard>目標額</SimpleCard>
      </v-col>
      <v-col cols="6">
        <SimpleCard>貯金額</SimpleCard>
      </v-col>
    </v-row>
  </div>
</template>
<script>
import SimpleCard from '../components/molecules/cards/SimpleCard.vue'
export default {
  name: 'HomePage',
  components: { SimpleCard }
}
</script>
