<template>
  <div> AAA</div>
</template>
<script>
  export default {
    middleware: 'guest',
    created() {
      if (this.$store.state.auth.user) {
        console.log('okkk')
      }
    }
  }
</script>