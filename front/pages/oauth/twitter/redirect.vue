<template>
  <div class="column is-6 is-offset-3 is-centered" style="margin-top: 5em;">
    <div class="card">
      <div class="card-content has-text-centered">
        <p class="title is-6">
          ソーシャルアカウントでログインする
        </p>
        <p>Twitterへリダイレクトしています。。。</p>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    asyncData({ app, error }) {
      return app.$axios
        .$get("/api/auth/twitter/")
        .then(response => {
          return {
            redirect_url: response.redirect_url
          };
        })
        .catch(e => {
          error({ message: e.message, statusCode: e.statusCode });
        });
    },

    mounted() {
     window.location.href = this.redirect_url;
    }
  };
</script>