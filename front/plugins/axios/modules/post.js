export default ({ $axios }, inject) => {
  const postApi = new PostApi($axios)
  inject('postApi', postApi)
}

class PostApi {
  constructor(axios) {
    this.axios = axios
  }

  async get() {
    return await this.axios.get('api/posts')
  }

  async getPostById(id) {
    return await this.axios.get(`api/posts/${id}`)
  }

  async getLikePosts() {
    return await this.axios.get('api/posts/like')
  }

  async create(post) {
    return await this.axios.post('api/posts', post)
  }

  async update(id, post) {
    return await this.axios.patch(`api/posts/${id}`, post)
  }

  async delete(id) {
    return await this.axios.delete(`api/posts/${id}`)
  }

  async like(id) {
    return await this.axios.patch(`api/posts/like/${id}`)
  }

  async unlike(id) {
    return await this.axios.delete(`api/posts/like/${id}`)
  }
}
