<template>
  <div class="about">
    <h1 @click=check>This is an about page</h1>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  methods: {
    check() {
      console.log('check');
      axios({
          method: 'get',
          url: 'http://localhost/~rrd/stockrvue/api/products/stock.json',
          withCredentials : true,
        })
        .then(resp => {
            console.log(resp);
        })
        .catch(err => console.error(err));
    }
  }
}
</script>

<style>

</style>