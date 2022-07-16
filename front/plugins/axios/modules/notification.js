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

  async check(id) {
    return await this.axios.patch(`api/notifications/${id}`)
  }
}
