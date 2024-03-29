import colors from 'vuetify/es5/util/colors'

const deploymentEnv = process.env.NODE_ENV || 'development'
const environment = require(`./env.${deploymentEnv}.js`)

export default {
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,

  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    titleTemplate: '%s - save for happiness',
    title: 'save for happiness',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.svg' }]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~/plugins/axios/index',
    '~/plugins/axios/modules/save',
    '~/plugins/axios/modules/target',
    '~/plugins/axios/modules/user',
    '~/plugins/axios/modules/news',
    '~/plugins/axios/modules/post',
    '~/plugins/axios/modules/notification',
    '~/plugins/error-handler',
    '~/plugins/guest-alert',
    '~/plugins/guest-judge',
    { src: '~/plugins/vue-tags-input', ssr: false }
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/eslint
    '@nuxtjs/eslint-module',
    // https://go.nuxtjs.dev/vuetify
    '@nuxtjs/vuetify',
    '@nuxtjs/moment'
  ],
  watchers: {
    webpack: {
      poll: true
    }
  },
  env: environment,
  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    '@nuxtjs/toast',
    '@nuxtjs/dotenv'
  ],
  loading: '~/components/singleInstance/TheLoading.vue',
  moment: {
    locales: ['ja']
  },
  toast: {
    position: 'top-center',
    duration: 4000
  },
  auth: {
    localStorage: false,
    cookie: {
      maxAge: 1800
    },
    redirect: {
      login: '/login',
      logout: '/',
      // callback: false,
      home: false
    },
    strategies: {
      laravelSanctum: {
        endpoints: {
          login: { url: '/api/login', method: 'post', propertyName: false },
          logout: { url: '/api/logout', method: 'post' },
          user: { url: '/api/user', method: 'get', propertyName: false }
        },
        provider: 'laravel/sanctum',
        url: `${environment.API_URL}`
      }
    }
  },
  router: {
    middleware: ['auth']
  },
  proxy: {
    '/api': {
      target: `${environment.API_URL}`
    }
  },
  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    // Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
    credentials: true,
    baseURL: `${environment.API_URL}`
  },

  // Vuetify module configuration: https://go.nuxtjs.dev/config-vuetify
  vuetify: {
    customVariables: ['~/assets/variables.scss'],
    theme: {
      dark: false,
      themes: {
        light: {
          background: colors.grey.lighten3
        },
        dark: {
          primary: colors.blue.darken2,
          accent: colors.grey.darken3,
          secondary: colors.amber.darken3,
          info: colors.teal.lighten1,
          warning: colors.amber.base,
          error: colors.deepOrange.accent4,
          success: colors.green.accent3
        }
      }
    }
  },

  publicRuntimeConfig: {
    appName: process.env.APP_NAME
  },
  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {}
}
