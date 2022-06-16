export const state = () => ({
  newsData: {
    business: [],
    entertainment: [],
    health: [],
    science: [],
    sports: [],
    technology: []
  },
  activeCategory: 'business'
})

export const getters = {
  getArticlesByCategory: (state) => {
    const category = state.activeCategory
    return state.newsData[category]
  }
}

export const mutations = {
  setArticles(state, data) {
    const newsData = data
    const newsCategory = state.activeCategory
    state.newsData[newsCategory] = newsData
  },

  setActiveCategory(state, category) {
    state.activeCategory = category
  }
}

export const actions = {
  getArticles({ commit, state }, data) {
    // const category = state.activeCategory
    // if (state.newsData[category].length) {
    //   return false
    // } else {
    //   const res = this.$newsApi.getNewsByCategory(category)
    //   console.log(res)
    //   // commit('setArticles', res.data)
    //   return res.data
    // }
    commit('setArticles', data)
  },
  updateCategory({ commit, state }, category) {
    if (state.activeCategory !== category) {
      commit('setActiveCategory', category)
    }
  }
}
