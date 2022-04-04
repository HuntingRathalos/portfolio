export default function ({ $axios, redirect, $toast }) {
  $axios.onError(error => {
    if(error.response.status === 400){
      $toast.error('もう一度入力内容をご確認ください。')
    }else{
      const errorCode = error.response.data.statusCode
      const message = error.response.data.message

      redirect(`/errors/${errorCode}/${message}`)
    }
  })
}
