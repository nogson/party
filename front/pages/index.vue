<template>
  <section>
    <b-button pill variant="primary" href="friend">仲間を探す</b-button>
  </section>
</template>
<script>

  export default {
    middleware: 'guest',
    layout: 'base',
    async asyncData({$axios, store,redirect}) {
      const userId = store.getters['auth/loggedUser'].id
      const res = await $axios.$get(`api/user/profile/${userId}`)
      if (res.profile === null) {
        redirect("/user");
      }
    },
    created() {

    }
  }
</script>