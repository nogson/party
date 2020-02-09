export default ({ $axios ,store}) => {
  $axios.onRequest(config => {
    if (store.state.auth.token) {
      config.headers.common['X-Requested-With'] = 'XMLHttpRequest'
      config.headers.common['Authorization'] = `Bearer ${store.state.auth.token}`
    }
    return config
  })
}