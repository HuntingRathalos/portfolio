import Vue from 'vue'

export default function ({ error: nuxtError }) {
  // Vuejs内のエラーを一元的に処理
  Vue.config.errorHandler = function (err, vm, info) {
    nuxtError({
      statusCode: 500,
      message: err.toString()
    })
    return Promise.resolve(false)
  }

  // Vuejs外のエラーを一元的に処理
  window.addEventListener('error', (event) => {
    nuxtError({
      statusCode: 500,
      message: event.message
    })
    return Promise.resolve(false)
  })

  window.addEventListener('unhandledrejection', (event) => {
    // alert(event.reason);
    console.log(event.reason)
  })
}
