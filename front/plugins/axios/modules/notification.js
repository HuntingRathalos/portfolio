export default ({ $axios }, inject) => {
  const notificationApi = new NotificationApi($axios)
  inject('notificationApi', notificationApi)
}

class NotificationApi {
  constructor(axios) {
    this.axios = axios
  }

  async get() {
    return await this.axios.get('api/notification')
  }

  async delete(id) {
    return await this.axios.delete(`api/notification/${id}`)
  }

  async check(id) {
    return await this.axios.patch(`api/notification/check/${id}`)
  }

  // dbから消すのではなくread_atを変更するだけ
  async uncheck(id) {
    return await this.axios.patch(`api/notification/check/${id}`)
  }
}
