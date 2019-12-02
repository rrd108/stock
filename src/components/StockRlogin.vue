<template>
<div class="users login form">
    <div class="row align-center">
        <img alt="StokR logo" src="../assets/img/logo.png">
    </div>
    <div class="row align-center">
        <h1>StockR</h1>
    </div>
    <form>
      <fieldset>
        <!--
          <div class="callout warning">
            <legend>Please enter your email and password</legend>
        </div>
        -->
        <div class="input email required">
          <label for="email">Email</label>
          <input type="email" name="email" required="required" id="email">
        </div>
        <div class="input password required">
          <label for="password">Jelszó</label>
          <input type="password" name="password" required="required" id="password">
        </div>

        <div class="input checkbox">
          <input type="hidden" name="remember_me" value="0">
          <label for="remember-me">
            <input type="checkbox" name="remember_me" value="1" checked="checked" id="remember-me">Emlékezz rám
          </label>
        </div>
    </fieldset>

    <div class="row align-center">
      <button class="button" type="submit" @click.prevent="login">Belép</button>
    </div>
  </form>

  <div class="row align-center">
    <a href="./users/register" class="column align-self-middle">Regisztrálok</a>
    <a href="./users/request-reset-password" class="column align-self-middle">Jelszó csere</a>
  </div>
</div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'StockRlogin',

  methods: {
    async login() {
      console.log('login');
      const qs = require('qs');
      axios({
          method: 'post',
          url: 'http://localhost/~rrd/stockrvue/api/user-get-token.json',
          withCredentials : true,
          data: qs.stringify({
            email: 'rrd@krisna.hu',
            password: '123'
          })
        })
        .then(resp => {
            console.log(resp);
        })
        .catch(err => console.error(err));
    }
  }
}
</script>

<style scoped>
.login {
    margin: 5em auto;
    width: 25em;
    border: thin solid #aaa;
    padding: 2em;
    box-shadow: 5px 10px 8px #aaa;
}
.login img {
    height: 5em;
    margin-bottom: 1rem;
}
</style>
