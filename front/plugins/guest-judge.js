export default ({ store }, inject) => {
  const guestJudge = function () {
    if (store.state.auth.user.id === 1) {
      return true
    }
    return false
  }
  inject('guestJudge', guestJudge)
}
