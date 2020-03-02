<template>
  <div class="content">

  </div>
</template>

<script>
  export default {
    name: "notification",
    middleware: 'guest',
    layout: 'base',
    async asyncData({$axios, store}) {
      // const userId = store.getters['auth/loggedUser'].id
      // const res = await $axios.$get(`api/user/profile/${userId}`)
      // let form = res.profile ? res.profile : {}
      // form.skill = res.skill
      // return {form, isNew: res.profile === null}
    },
    data() {
      return {
      }
    },
    created() {
    },
    methods: {
    }
  }
</script>

<style scoped lang="scss">
  .content {
    padding: 24px;
  }


</style>