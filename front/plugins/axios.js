export default function ({ $axios, redirect}) {
  $axios.onError(error => {
    const errorCode = error.response.data.statusCode
    const message = error.response.data.message

    redirect(`/errors/${errorCode}/${message}`)
  })
}
