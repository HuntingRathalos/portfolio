// eslint-disable-next-line import/no-mutable-exports
// export let axios

export default function ({ $axios, $toast, error: nuxtError }) {
  $axios.onError((error) => {
    if (error.response.status === 400) {
      $toast.error('もう一度入力内容をご確認ください。')
    } else {
      nuxtError({
        statusCode: error.response.data.statusCode,
        message: error.response.data.message
      })
      return Promise.resolve(false)
    }
  })

  // axios = $axios
}
