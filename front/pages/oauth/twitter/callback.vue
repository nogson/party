<template>
  <div class="column is-6 is-offset-3 is-centered" style="margin-top: 5em;">
    <div class="card">
      <div class="card-content has-text-centered">
        <p class="title is-6">
          ソーシャルアカウントでログインする
        </p>
        <p v-if="attempting">Twitterでログインを行っています。。。</p>
        <p v-else>Twitterでのログインに失敗しました！</p>
        <p>{{ failedMessage }}</p>
      </div>
    </div>
  </div>
</template>

<script>
  import {mapMutations} from "vuex";

  export default {
    data() {
      return {
        failedMessage: null
      };
    },

    computed: {
      attempting() {
        return !this.failedMessage;
      }
    },
    mounted() {
      this.$axios
        .$get("/api/auth/twitter/callback", {
          params: this.$route.query
        })
        .then(response => {
          this.setToken({token: response.access_token})
          this.setUser({user: response.user})
          this.$router.push("/");
        })
        .catch(error => {
          this.failedMessage = error.message;
        });
    },

    methods: mapMutations({
      setUser: "auth/setUser",
      setToken: "auth/setToken",
      setLoggedIn: "auth/setLoggedIn"
    })
  };
</script>