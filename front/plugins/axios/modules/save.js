export default ({ $axios }, inject) => {
  const saveApi = new SaveApi($axios)
  inject('saveApi', saveApi)
}

class SaveApi {
  constructor(axios) {
    this.axios = axios
  }

  async getSavesAmount() {
    return await this.axios.get('api/saves/amount')
  }

  async getOneWeek() {
    return await this.axios.get('/api/saves/week')
  }

  async getGroupedByTag() {
    return await this.axios.get('/api/saves/tag')
  }

  // async getOneWeek(date) {
  //   return await this.axios.get(`api/saves/${date}`)
  // }

  async get() {
    return await this.axios.get('api/saves')
  }

  async getSaveRanking() {
    return await this.axios.get('api/saves/ranking')
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
