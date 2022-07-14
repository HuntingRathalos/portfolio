export default ({ $axios }, inject) => {
  const notificationApi = new NotificationApi($axios)
  inject('notificationApi', notificationApi)
}

class NotificationApi {
  constructor(axios) {
    this.axios = axios
  }

  async get() {
    return await this.axios.get('api/notifications')
  }

  async delete(id) {
    return await this.axios.delete(`api/notifications/${id}`)
  }

  async check(id) {
    return await this.axios.patch(`api/notifications/${id}`)
  }

  // dbから消すのではなくread_atを変更するだけ
  // async uncheck(id) {
  //   return await this.axios.patch(`api/notification/check/${id}`)
  // }
}
