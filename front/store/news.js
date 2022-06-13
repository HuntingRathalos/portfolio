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
    const newsData = data.data
    const newsCategory = data.category
    state.newsData[newsCategory] = newsData
  },

  setActiveCategory(state, category) {
    state.activeCategory = category
  }
}

export const actions = {
  getArticles({ commit, state }) {
    const category = state.activeCategory
    if (state.newsData[category].length) {
      return false
    } else {
      // const newsArticles = await changeCategory(category)
      const res = this.$newsApi.getNewsByCategory(category)
      commit('setArticles', res.data)
      // return res.data
    }
  },
  updateCategory({ commit, state }, category) {
    if (state.activeCategory !== category) {
      commit('setActiveCategory', category)
    }
  }
}
