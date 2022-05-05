export default ({ $axios }, inject) => {
  const targetApi = new TargetApi($axios)
  inject('targetApi', targetApi)
}

class TargetApi {
  constructor(axios) {
    this.axios = axios
  }

  async get() {
    return await this.axios.get('api/targets')
  }

  async create(target) {
    return await this.axios.post('api/targets', target)
  }

  async update(id, target) {
    return await this.axios.patch(`api/targets/${id}`, target)
  }

  async delete(id) {
    return await this.axios.delete(`api/targets/${id}`)
  }
}
