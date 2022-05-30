export default ({ $toast }, inject) => {
  const guestAlert = function () {
    $toast.error('ゲストユーザーには無効な操作です。')
  }
  inject('guestAlert', guestAlert)
}
