export const state = () => ({
  notifications: []
})

export const getters = {
  notifications: (state) => state.notifications
}

export const mutations = {
  get(state, payload) {
    state.notifications = payload
  }
}

export const actions = {
  get({ commit }, payload) {
    commit('get', payload)
  }
}
