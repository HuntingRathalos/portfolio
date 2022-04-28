export default ({ $axios }, inject) => {
  const saveApi = new SaveApi($axios)
  inject('saveApi', saveApi)
}

class SaveApi {
  constructor(axios) {
    this.axios = axios
  }

  // async getOneMonth(date) {
  //   return await this.axios.get(`api/saves/${date}`)
  // }

  async getOneWeek(date) {
    return await this.axios.get(`api/saves/${date}`)
  }

  async get() {
    return await this.axios.get('api/saves')
  }

  async create(save) {
    return await this.axios.post('api/saves', save)
  }

  async update(id, save) {
    return await this.axios.patch(`api/saves/${id}`, save)
  }

  async delete(id) {
    return await this.axios.delete(`api/saves/${id}`)
  }
}
