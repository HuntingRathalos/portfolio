export default function ({ $axios, $toast, error: nuxtError, store }) {
  $axios.onRequest((config) => {
    store.dispatch('loading/incrementLoadingCount')
  })

  $axios.onResponse(() => {
    store.dispatch('loading/decrementLoadingCount')
  })

  $axios.onError((error) => {
    store.dispatch('loading/decrementLoadingCount')
    if (error.response.status === 400) {
      $toast.error('もう一度入力内容をご確認ください。')
    } else {
      nuxtError({
        statusCode: error.response.data.statusCode,
        message: error.response.data.message
      })
      // return Promise.resolve(false)
      return Promise.reject(error)
    }
  })
}
