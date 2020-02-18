export const actions = {
  // ユーザーの訪問時（SSR）で呼ばれるメソッド
  async nuxtServerInit({ dispatch, state, commit }, { error }) {
    const token = this.$cookies.get('token')

    if (!token) {
      return Promise.resolve()
    }

    return dispatch('fetchUserByAccessToken', { token }).catch(e => {
      return dispatch('auth/logout').catch(e => {
        error({ message: e.message, statusCode: e.statusCode })
      })
    })
  },
  fetchUserByAccessToken ({ commit, dispatch }, { token }) {

    commit('auth/setToken', { token })

    return this.$axios.$get('/api/user').then(user => {
      commit('auth/setUser', { user })
    })
  }
}