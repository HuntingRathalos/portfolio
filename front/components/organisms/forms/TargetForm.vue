<template>
  <div>
    <alert-dialog @runMethod="deleteTarget">
      <template #btnText
        >この操作は取り消せません。<br />これまでの貯金記録も削除しますがよろしいですか?</template
      >
    </alert-dialog>
    <v-card max-width="500" class="mx-auto mt-5 full-width" flat outlined>
      <v-card-title class="text-center pa-8">
        <h1 class="text-h5 font-weight-bold full-width">{{ titleText }}</h1>
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

      <v-divider> </v-divider>

      <v-card-actions v-if="updateFlag" class="ml-auto">
        <div class="ml-auto">
          <v-btn
            icon
            text
            color="grey darken-2"
            @click.prevent="openAlertModal"
          >
            <v-icon> mdi-delete </v-icon>
          </v-btn>
        </div>
      </v-card-actions>
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
      btnColor: 'orange',
      form: {
        name: '',
        amount: ''
      },
      updateFlag: false
    }
  },
  computed: {
    buttonText() {
      return this.updateFlag ? '更新する' : '作成する'
    },
    titleText() {
      return this.updateFlag ? '目標更新' : '目標作成'
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
        if (this.$guestJudge()) {
          this.$guestAlert()
          return
        }
        const target = JSON.parse(sessionStorage.getItem('target'))
        if (target) {
          this.$targetApi
            .update(target.id, this.form)
            .then((res) => {
              sessionStorage.setItem('target', JSON.stringify(res.data))
              this.$router.push('/top-page')
              this.$toast.success('目標を更新しました。')
            })
            .catch(() => this.$toast.error('目標の更新に失敗しました。'))
        } else {
          this.$targetApi
            .create(this.form)
            .then((res) => {
              sessionStorage.setItem('target', JSON.stringify(res.data))
              this.updateFlag = true
              this.$router.push('/top-page')
              this.$toast.success('目標を作成しました。')
            })
            .catch(() => this.$toast.error('目標の作成に失敗しました。'))
        }
      }
    },
    deleteTarget() {
      if (this.$refs.target_form.validate()) {
        if (this.$guestJudge()) {
          this.$guestAlert()
          return
        }
        this.$store.dispatch('modal/setOpenAlertModal', false)
        const target = JSON.parse(sessionStorage.getItem('target'))
        this.$targetApi
          .delete(target.id)
          .then(() => {
            sessionStorage.removeItem('target')
            sessionStorage.removeItem('saves')
            sessionStorage.removeItem('saveAmount')
            this.updateFlag = false
            this.$router.push('/top-page')
            this.$toast.success('削除に成功しました。')
          })
          .catch(() => this.$toast.error('目標の削除に失敗しました。'))
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
