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
  import { mapMutations } from "vuex";

  export default {
   // middleware: "guest",
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
        .$get("http://localhost/api/auth/twitter/callback", {
          params: this.$route.query
        })
        .then(response => {
          // this.setUser(response.user);
          // this.setLoggedIn(true);

          this.$router.push("/home");
        })
        .catch(error => {
          //this.failedMessage = error.message;
        });
    },

    // methods: mapMutations({
    //   setUser: "auth/setUser",
    //   setLoggedIn: "auth/setLoggedIn"
    // })
  };
</script>