export const state = () => ({
  openSaveModal: false,
  openAlertModal: false,
  openCreatePostModal: false,
  openEditPostModal: false
})

export const getters = {
  openSaveModal: (state) => state.openSaveModal,
  openAlertModal: (state) => state.openAlertModal,
  openCreatePostModal: (state) => state.openCreatePostModal,
  openEditPostModal: (state) => state.openEditPostModal
}

export const mutations = {
  setOpenSaveModal(state, openSaveModal) {
    state.openSaveModal = openSaveModal
  },
  setOpenAlertModal(state, openAlertModal) {
    state.openAlertModal = openAlertModal
  },
  setOpenCreatePostModal(state, openCreatePostModal) {
    state.openCreatePostModal = openCreatePostModal
  },
  setOpenEditPostModal(state, openEditPostModal) {
    state.openEditPostModal = openEditPostModal
  }
}

export const actions = {
  setOpenSaveModal({ commit }, openSaveModal) {
    commit('setOpenSaveModal', openSaveModal)
  },
  setOpenAlertModal({ commit }, openAlertModal) {
    commit('setOpenAlertModal', openAlertModal)
  },
  openCreatePostModal({ commit }, openCreatePostModal) {
    commit('setOpenCreatePostModal', openCreatePostModal)
  },
  setOpenEditPostModal({ commit }, openEditPostModal) {
    commit('setOpenEditPostModal', openEditPostModal)
  }
}
