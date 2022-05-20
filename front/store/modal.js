export const state = () => ({
  openSaveModal: false,
  openAlertModal: false
})

export const getters = {
  openSaveModal: (state) => state.openSaveModal,
  openAlertModal: (state) => state.openAlertModal
}

export const mutations = {
  setOpenSaveModal(state, openSaveModal) {
    state.openSaveModal = openSaveModal
  },
  setOpenAlertModal(state, openAlertModal) {
    state.openAlertModal = openAlertModal
  }
}

export const actions = {
  setOpenSaveModal({ commit }, openSaveModal) {
    commit('setOpenSaveModal', openSaveModal)
  },
  setOpenAlertModal({ commit }, openAlertModal) {
    commit('setOpenAlertModal', openAlertModal)
  }
}
