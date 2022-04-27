export const state = () => ({
  openSaveModal: false,
  savings: [],
  clickDate: ''
})

export const getters = {
  // 特定イベントを抜き出すもの,
  openSaveModal: (state) => state.openSaveModal
}

export const mutations = {
  setOpenSaveModal(state, openSaveModal) {
    state.openSaveModal = openSaveModal
  }
}

export const actions = {
  setOpenSaveModal({ commit }, openSaveModal) {
    commit('setOpenSaveModal', openSaveModal)
  },
  async createSave({ commit, getters }) {
    const response = await this.$saveApi.create(getters.saving)
    console.log(response)
    commit('setSaving', response.data)
  }
}
