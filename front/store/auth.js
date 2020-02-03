export const state = () => ({
  user: null,
  loggedIn: false,
})

export const mutations = {
  setUser(state, user) {
    state.user = user
    state.loggedIn = Boolean(user)
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

}