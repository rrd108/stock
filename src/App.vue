<template>
  <div id="app">
    <stockRheader v-if="isLoggedIn" />
    <router-view/>
  </div>
</template>

<script>

import StockRheader from '@/components/StockRheader.vue'

export default {
  name: 'app',

  components: {
    StockRheader
  },

  computed : {
      isLoggedIn() {
        return this.$store.state.user.email ? true : false;
      }
  },
}
</script>

<style>
@import url('https://fonts.googleapis.com/css?family=Quicksand');
@import url('./assets/css/foundation.min.css');
@import url('./assets/css/foundation-icons.min.css');

#app {
  font-family: 'Quicksand', sans-serif;
  color: #2c3e50;
}
</style>
