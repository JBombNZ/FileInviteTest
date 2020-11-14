<template>

  <div>

    Welcome back {{ $store.state.user.name }}

  </div>

</template>

<script>
  export default {

    mounted () {
      console.log(this.$store.state)
    }

  }
</script>