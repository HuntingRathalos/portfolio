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
  delete(state, payload) {
    state.notifications = state.notifications.filter(
      (notifications) => notifications.id !== payload
    )
  },
  check(state) {
    --state.unreadNum
    // const notification = state.notifications.find(
    //   (notification) => notification.id === payload.id
    // )
    // Object.assign(notification, payload)
      // notification.read_at = false
  }
  // uncheck(state) {
  //   ++state.unreadNum
  // }
}

export const actions = {
  get({ commit }, payload) {
    commit('get', payload)
  },
  delete({ commit }, payload) {
    commit('delete', payload)
  },
  check({ commit }) {
    commit('check')
  }
  // uncheck({ commit }) {
  //   commit('uncheck')
  // }
}
