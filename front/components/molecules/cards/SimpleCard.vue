<template>
  <v-card outlined height="108">
    <v-card-text class="black--text">
      <div class="text-body-1">
        <slot name="amountName"></slot>
      </div>
      <div class="text-h6 font-weight-medium">
        <!-- 30000円 -->
        <slot name="amount">0円</slot>
      </div>
      <div class="text-body-2 text--secondary">
        <!-- 目標まで :20000円 -->
        <slot name="content"> </slot>
      </div>
    </v-card-text>
  </v-card>
</template>
<script>
export default {
  //  props: {
  //   target: {
  //     type: Object,
  //     default: null
  //   },
  //   saveAmount: {
  //     type: String,
  //     default: null
  //   },
  //   remainAmount: {
  //     type: String,
  //     default: null
  //   }
  // },
}
</script>
