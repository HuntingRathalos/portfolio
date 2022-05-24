export default ({ $auth, redirect }) => {
  // ログイン後ユーザーのリダイレクト処理
  if ($auth.loggedIn) {
    return redirect('/top-page')
  }
}
