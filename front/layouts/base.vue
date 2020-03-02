<template>
  <div>
    <b-navbar variant="faded" type="light">
      <b-navbar-brand href="/">PARTY</b-navbar-brand>
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="ml-auto">
          <b-nav-item v-if="isAuthenticated" href="notification" variant="primary">通知</b-nav-item>
          <b-nav-item v-if="isAuthenticated" @click="logout" variant="primary">ログアウト</b-nav-item>
          <b-nav-item v-if="!isAuthenticated" href="/oauth/twitter/redirect" variant="primary">Twitterでログイン</b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <nuxt/>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    computed:{
      ...mapGetters({
        isAuthenticated: 'auth/isAuthenticated'
      })
    },
    methods:{
      logout() {
        this.$axios
          .$post('api/oauth/token/destroy').then(() => {
          this.$router.push('login')

        })
      }
    }
  }
</script>

<style>

</style>

