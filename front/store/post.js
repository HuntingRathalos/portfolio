export const state = () => ({
  posts: [],
  likePosts: []
})

export const getters = {
  posts: (state) => state.posts,
  likePosts: (state) => state.likePosts
}

export const mutations = {
  get(state, payload) {
    state.posts = payload
  },
  getLiked(state, payload) {
    state.likePosts = payload
  },
  create(state, payload) {
    state.posts.unshift(payload)
  },
  update(state, payload) {
    state.posts = state.posts.filter((post) => post.id !== payload.id)
    state.posts.unshift(payload)
    // const post = state.posts.find((post) => post.id === payload.id)
    // Object.assign(post, payload)
  },
  delete(state, payload) {
    state.posts = state.posts.filter((post) => post.id !== payload)
  },
  like(state, payload) {
    state.likePosts.unshift(payload)
  },
  unlike(state, payload) {
    state.likePosts = state.likePosts.filter(
      (likePost) => likePost.id !== payload
    )
  }
}

export const actions = {
  get({ commit }, payload) {
    commit('get', payload)
  },
  getLiked({ commit }, payload) {
    commit('getLiked', payload)
  },
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
    commit('unlike', payload)
  }
}
