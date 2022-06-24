<template>
  <div class="">
    <v-dialog v-model="isOpenEditPostModal" max-width="500px" persistent>
      <v-card class="mx-auto">
        <v-toolbar class="indigo accent-1" flat>
          <v-toolbar-title class="white--text font-weight-bold">
            振り返り記録を編集する
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-icon dark @click="closeModal"> mdi-close </v-icon>
        </v-toolbar>
        <v-form>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12" class="pa-0">
                  <good-description-input
                    :good-description.sync="post.good_description"
                  />
                </v-col>
                <v-col cols="12" class="pa-0">
                  <bad-description-input
                    :bad-description.sync="post.bad_description"
                  />
                </v-col>
                <v-col cols="12" class="pa-0">
                  <span>自己評価</span>
                  <v-row justify="center">
                    <v-rating
                      v-model="post.self_evaluation"
                      background-color="orange lighten-3"
                      color="orange"
                      large
                      length="5"
                      size="64"
                    ></v-rating>
                  </v-row>
                </v-col>
                <v-col cols="12">
                  <v-row justify="center pt-5">
                    <v-btn
                      color="success"
                      class="white--text"
                      @click="updatePost"
                      >送信
                    </v-btn>
                  </v-row>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
        </v-form>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
import BadDescriptionInput from '../../atoms/inputs/BadDescriptionInput.vue'
import GoodDescriptionInput from '../../atoms/inputs/GoodDescriptionInput.vue'
export default {
  components: { GoodDescriptionInput, BadDescriptionInput },
  props: {
    postId: {
      type: Number,
      default: null
    },
  },
  data() {
    return {
      post: {
        good_description: '',
        bad_description: '',
        self_evaluation: 3,
      }
    }
  },
  computed: {
    ...mapGetters('modal', {
      openEditPostModal: 'openEditPostModal'
    }),
    isOpenEditPostModal: {
      get() {
        return this.openEditPostModal
      },
      set(newVal) {
        this.setOpenEditPostModal(newVal)
      }
    }
  },
  watch: {
    async postId () {
      await this.getPostById()
    }
  },
  // mounted() {
  //   this.getPostById()
  // },
  methods: {
    ...mapActions({
      setOpenEditPostModal: 'modal/setOpenEditPostModal',
      update: 'post/update'
    }),
    closeModal() {
      this.setOpenEditPostModal(false)
    },
    getPostById() {
      this.$postApi.getPostById(this.postId).then((res) => {
        console.log(res)
        // Object.assign(this.post, res.data)
        this.post.good_description = res.data.good_description
        this.post.bad_description = res.data.bad_description
        this.post.self_evaluation = res.data.self_evaluation
      })
    },
    updatePost() {
      this.$postApi
        .update(this.postId, this.post)
        .then((res) => {
          console.log(res)
          this.update(res.data)
          this.closeModal()
          this.$toast.success('記録を更新しました。')
        })
        .catch(() => this.$toast.error('記録の更新に失敗しました。'))
    }
  }
}
</script>
