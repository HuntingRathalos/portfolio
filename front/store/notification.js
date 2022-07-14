export const state = () => ({
  notifications: [],
  unreadNum: 0
})

export const getters = {
  notifications: (state) => state.notifications,
  unreadNum: (state) => state.unreadNum
}

export const mutations = {
  get(state, payload) {
    state.notifications = payload
  },
  check(state) {
    --state.unreadNum
  }
}

export const actions = {
  get({ commit }, payload) {
    commit('get', payload)
  },
  check({ commit }) {
    commit('check')
  }
}
