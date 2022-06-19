export const state = () => ({
  posts: [],
  likePosts: []
})

export const getters = {
  posts: (state) => state.posts
}

export const mutations = {
  create(state, payload) {
    state.posts.unshift(payload)
  },
  update(state, payload) {
    const post = state.posts.find((post) => post.id === payload.id)
    Object.assign(post, payload)
  },
  delete(state, payload) {
    state.posts.filter((post) => post.id !== payload.id)
  },
  like(state, payload) {
    state.likePosts.unshift(payload)
  },
  unlike(state, payload) {
    state.likePosts.filter((likePost) => likePost.id !== payload.id)
  }
}

export const actions = {
  create({ commit }, payload) {
    commit('create', payload)
  },
  update({ commit }, payload) {
    commit('update', payload)
  },
  delete({ commit }, payload) {
    commit('delete', payload)
  },
  like({ commit }, payload) {
    commit('like', payload)
  },
  unlike({ commit }, payload) {
    commit('like', payload)
  }
}
