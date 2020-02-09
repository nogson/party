
const inBrowser = typeof window !== 'undefined'

export const state = () => ({
  user: null,
  token:null,
  loggedIn: false,
})

export const mutations = {
  setUser(state, { user }) {
    state.user = user
    state.loggedIn = Boolean(user)
  },
  setToken(state, { token }){
    state.token = token

    // Store token in cookies
    if (inBrowser) {
      if (token) {
        this.$cookies.set('token', token)
      } else {
        this.$cookies.remove('token')
      }
    }
  },
  setLoggedIn(state, bool) {
    state.loggedIn = bool;
  }
}

export const getters = {
  isAuthenticated: state => {
    return state.loggedIn;
  },

  loggedUser: state => {
    return state.user;
  }
};

export const actions = {
  logout ({ commit }) {
    commit('setUser', { user: null })

    // Revoke access token
    return this.$axios.delete('/oauth/token/destroy').then(() => {
      commit('setToken', { token: null })
    }).catch(e => {
      commit('setToken', { token: null })
    })
  }
}