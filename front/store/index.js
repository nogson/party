export const actions = {
  // ユーザーの訪問時（SSR）で呼ばれるメソッド
  async nuxtServerInit({ commit }, { app }) {

    await app.$axios
      .$get("/user")
      .then(response => {
        console.log('dddd')

        commit("auth/setUser", response.user);
        commit("auth/setLoggedIn", true);
      })
      .catch(() => {
        console.log('okkkk')

        commit("auth/setUser", null);
        commit("auth/setLoggedIn", false);
      });
  }
}