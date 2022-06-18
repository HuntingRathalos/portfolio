export const state = () => ({
  posts: [
    {
      id: 1,
      name: '雨'
    },
    {
      id: 2,
      name: 'とり'
    },
    {
      id: 3,
      name: '草'
    }
  ],
  likePosts: []
})

export const getters = {
  posts: (state) => state.posts
}

export const mutations = {
  createPost(state, payload) {
    console.log(payload)
    state.posts.unshift(payload)
  },
  updatePost(state, payload) {
    const post = state.posts.find((post) => post.id === payload.id)
    Object.assign(post, payload)
  },
  deletePost(state, payload) {
    state.posts.filter((post) => post.id !== payload.id)
  },
  likePost(state, payload) {
    state.likePosts.unshift(payload)
  },
  unlikePost(state, payload) {
    state.likePosts.filter((likePost) => likePost.id !== payload.id)
  }
}

export const actions = {
  createPost({ commit }, payload) {
    commit('createPost', payload)
  },
  updatePost({ commit }, payload) {
    commit('updatePost', payload)
  },
  deletePost({ commit }, payload) {
    commit('deletePost', payload)
  },
  likePost({ commit }, payload) {
    commit('likePost', payload)
  },
  unlikePost({ commit }, payload) {
    commit('likePost', payload)
  }
}
