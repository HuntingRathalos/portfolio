<template>
  <v-card width="400px" class="mx-auto mt-5">
    <v-card-title>
      <h1 class="display-1">{{ titleText }}</h1>
      <span v-if="updateFlag">
        <v-icon @click.prevent="deleteTarget">mdi-delete</v-icon>
      </span>
    </v-card-title>
    <v-card-text>
      <v-form ref="target_form" @submit.prevent>
        <target-name-input :target-name.sync="form.name" />
        <target-amount-input :target-amount.sync="form.amount" />
        <v-card-actions>
          <v-row justify="end">
            <base-button @click.native="createOrUpdateTarget"
              >{{ buttonText }}
            </base-button>
          </v-row>
        </v-card-actions>
      </v-form>
    </v-card-text>
  </v-card>
</template>
<script>
import BaseButton from '../../atoms/buttons/BaseButton.vue'
import TargetAmountInput from '../../atoms/inputs/TargetAmountInput.vue'
import TargetNameInput from '../../atoms/inputs/TargetNameInput.vue'
export default {
  components: { TargetNameInput, TargetAmountInput, BaseButton },
  data() {
    return {
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
        const target = JSON.parse(sessionStorage.getItem('target'))
        this.$targetApi.delete(target.id).then((res) => {
          sessionStorage.removeItem('target')
          sessionStorage.removeItem('saves')
          sessionStorage.removeItem('saveAmount')
          this.updateFlag = false
          this.$router.push('/home')
        })
      }
    }
  }
}
</script>
