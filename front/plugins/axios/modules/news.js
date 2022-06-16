export default ({ $axios }, inject) => {
  const newsApi = new NewsApi($axios)
  inject('newsApi', newsApi)
}

class NewsApi {
  constructor(axios) {
    this.axios = axios
  }

  async getNewsByCategory(category) {
    return await this.axios.get(`api/news?category=${category}`)
  }
}
