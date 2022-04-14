export const state = () => ({
  openSaveModal: false,
  savings: [],
  saving: {
    clickDate: '',
    coins: 0,
    memo: '',
    iconCode: ''
  }
})

export const getters = {
  // 特定イベントを抜き出すもの,
  openSaveModal: (state) => state.openSaveModal,
  clickDate: (state) => state.saving.clickDate,
  coins: (state) => state.saving.coins,
  multipleCoin(state) {
    if (state.saving.coins > 0) {
      return `+${state.saving.coins * 500}`
    }
    return state.saving.coins * 500
  },
  memo: (state) => state.saving.memo
}

export const mutations = {
  setOpenSaveModal(state, openSaveModal) {
    state.openSaveModal = openSaveModal
  },
  setClickDate(state, clickDate) {
    state.saving.clickDate = clickDate
  },
  setCoin(state, coins) {
    state.saving.coins = coins
  },
  setMemo(state, memo) {
    state.saving.memo = memo
  },
  setIconCode(state, iconCode) {
    state.saving.iconCode = iconCode
  },
  incrementCoin(state) {
    state.saving.coins++
  },
  decrementCoin(state) {
    state.saving.coins--
  }
}

export const actions = {
  setOpenSaveModal({ commit }, openSaveModal) {
    commit('setOpenSaveModal', openSaveModal)
  },
  setClickDate({ commit }, clickDate) {
    commit('setClickDate', clickDate)
  },
  setCoin({ commit }, coins) {
    commit('setCoin', coins)
  },
  setMemo({ commit }, memo) {
    commit('setMemo', memo)
  },
  setIconCode({ commit }, iconCode) {
    commit('setMemo', iconCode)
  },
  incrementCoin({ commit }) {
    commit('incrementCoin')
  },
  decrementCoin({ commit }) {
    commit('decrementCoin')
  }
}
