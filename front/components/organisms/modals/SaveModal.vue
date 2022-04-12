<template>
  <v-row justify="center">
    <v-dialog
      v-model="isOpenSaveModal"
      persistent
      max-width="600px"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5">貯金記録作成</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  :value="$store.getters['save/clickDate']"
                  prepend-icon="mdi-clock-time-eight-outline"
                  readonly
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <MemoInput />
              </v-col>
              <v-col cols="12">
              </v-col>
              <v-col cols = "12" class = "text-right">
                <span
                  class="text-h2 font-weight-light"

                >{{ $store.getters['save/multipleCoin'] }}</span>
                <span class="subheading font-weight-light mr-1">円</span>
              </v-col>

              <v-col cols="12">
                <SaveModalSlider />
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="$store.dispatch('save/setOpenSaveModal', false)"
          >
            Close
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="$store.dispatch('save/setOpenSaveModal', false)"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
import MemoInput from '../../atoms/inputs/MemoInput.vue'
import SaveModalSlider from '../../molecules/sliders/SaveModalSlider.vue'
export default{
  components: { MemoInput, SaveModalSlider },
  computed: {
      animationDuration () {
        return `${60 / this.$store.getters['save/multipleCoin']}s`
      },
      isOpenSaveModal: {
        get() {
          return this.$store.getters['save/openSaveModal']
        },
        set(newVal) {
          this.$store.dispatch('save/setOpenSaveModal', newVal)
        }
      },
    },
}
</script>
