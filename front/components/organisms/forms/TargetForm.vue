<template>
  <div class="">
    <alert-dialog @runMethod="deleteTarget" />
    <v-card max-width="500" class="mx-auto mt-5 full-width" flat outlined>
      <v-card-title class="text-center pa-8">
        <h1 class="text-h5 font-weight-bold full-width">{{ titleText }}</h1>
        <div v-if="updateFlag" class="ml-auto">
          <v-icon class="ml-auto" @click.prevent="openAlertModal"
            >mdi-delete</v-icon
          >
        </div>
      </v-card-title>
      <v-divider> </v-divider>
      <div class="px-6 py-8">
        <div style="max-width: 336px" class="mx-auto">
          <v-card-text>
            <v-form ref="target_form" @submit.prevent>
              <target-name-input :target-name.sync="form.name" />
              <target-amount-input :target-amount.sync="form.amount" />
              <v-card-actions>
                <v-row justify="end">
                  <base-button
                    :color="btnColor"
                    @click.native="createOrUpdateTarget"
                    >{{ buttonText }}
                  </base-button>
                </v-row>
              </v-card-actions>
            </v-form>
          </v-card-text>
        </div>
      </div>
    </v-card>
  </div>
</template>
<script>
import BaseButton from '../../atoms/buttons/BaseButton.vue'
import TargetAmountInput from '../../atoms/inputs/TargetAmountInput.vue'
import TargetNameInput from '../../atoms/inputs/TargetNameInput.vue'
import AlertDialog from '../modals/AlertDialog.vue'
export default {
  components: { TargetNameInput, TargetAmountInput, BaseButton, AlertDialog },
  data() {
    return {
      btnColor: 'indigo accent-2',
      form: {
        name: '',
        amount: ''
      },
      updateFlag: false
    }
  },
  computed: {
    buttonText() {
      return this.updateFlag ? '更新する' : '登録する'
    },
    titleText() {
      return this.updateFlag ? '目標更新' : '目標登録'
    }
  },
  created() {
    const target = JSON.parse(sessionStorage.getItem('target'))
    if (target) {
      this.form.name = target.name
      this.form.amount = target.amount
      this.updateFlag = true
    }
  },
  methods: {
    createOrUpdateTarget() {
      if (this.$refs.target_form.validate()) {
        const target = JSON.parse(sessionStorage.getItem('target'))
        if (target) {
          this.$targetApi.update(target.id, this.form).then((res) => {
            console.log(res)
            sessionStorage.setItem('target', JSON.stringify(res.data))
            this.$router.push('/home')
          })
        } else {
          this.$targetApi.create(this.form).then((res) => {
            console.log(res)
            sessionStorage.setItem('target', JSON.stringify(res.data))
            this.updateFlag = true
            this.$router.push('/home')
          })
        }
      }
    },
    deleteTarget() {
      if (this.$refs.target_form.validate()) {
        this.$store.dispatch('modal/setOpenAlertModal', false)
        const target = JSON.parse(sessionStorage.getItem('target'))
        this.$targetApi.delete(target.id).then((res) => {
          sessionStorage.removeItem('target')
          sessionStorage.removeItem('saves')
          sessionStorage.removeItem('saveAmount')
          this.updateFlag = false
          this.$router.push('/top-page')
        })
      }
    },
    openAlertModal() {
      this.$store.dispatch('modal/setOpenAlertModal', true)
    }
  }
}
</script>
<style scoped>
.full-width {
  width: 100%;
}
</style>
