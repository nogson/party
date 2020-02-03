module.exports = {
  /*
  ** Headers of the page
  */
  head: {
    title: 'front',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Nuxt.js project' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  /*
  ** Customize the progress bar color
  */
  loading: { color: '#3B8070' },
  /*
  ** Build configuration
  */
  build: {
    /*
    ** Run ESLint on save
    */
    extend (config, { isDev, isClient }) {
      if (isDev && isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }
    }
  },
  srcDir: 'front',
  plugins: [
    { src: "@/plugins/axios" }
  ],
  modules: [
    '@nuxtjs/axios',
    'bootstrap-vue/nuxt',
    '@nuxtjs/style-resources'
  ],
  css: [
    // プロジェクト内の SASS ファイル
    { src: '@/assets/scss/style.scss', lang: 'scss' }
  ],
  axios: {
    baseURL: "http://localhost",
    credentials: true
  },
  styleResources: {
    scss: [
      '~/assets/scss/index.scss',
      '~/assets/scss/util.scss'

    ]
  }

}

