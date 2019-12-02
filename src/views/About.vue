<template>
  <div class="about">
    <h1 @click=check>This is an about page</h1>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  methods : {
    check() {
      axios.get('http://localhost/~rrd/stockR/api/products/stock.json')
          .then(response => {
            console.log(response.data);
          })
          .catch(err => console.log(err));
    }
  }
}
</script>

<style>

</style>