<template>
  <div class="login">
    <div>
      <b-button @click="login" pill variant="primary">Twitterでログイン</b-button>
    </div>
  </div>
</template>

<script>
  export default {
    name: "login",
    methods:{
      login(){
        this.$router.push('/oauth/twitter/redirect')
      }
    }
  }
</script>

<style scoped lang="scss">
  .login{
    display: flex;
    height: 100vh;
    justify-content: center;
    align-items: center;
  }
</style>