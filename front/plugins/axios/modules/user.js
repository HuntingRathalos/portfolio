export default ({ $axios }, inject) => {
  const userApi = new UserApi($axios)
  inject('userApi', userApi)
}

class UserApi {
  constructor(axios) {
    this.axios = axios
  }

  async getUsersExceptMyself() {
    return await this.axios.get('api/users')
  }

  async getFollowUsers() {
    return await this.axios.get('api/users/follow')
  }

  async getFollowUsersId() {
    return await this.axios.get('api/users/follow_id')
  }

  async follow(id) {
    return await this.axios.patch(`api/users/follow/${id}`)
  }

  async unfollow(id) {
    return await this.axios.delete(`api/users/follow/${id}`)
  }
}
