<template>
  <div class="home">
    <StockRlogin v-if="!isLoggedIn" />
  </div>
</template>

<script>
// @ is an alias to /src
import StockRlogin from '@/components/StockRlogin.vue'

export default {
  name: 'home',

  components: {
    StockRlogin
  },

  computed : {
      isLoggedIn() {
        return this.$store.state.user.email ? true : false;
      }
  },
}
</script>
