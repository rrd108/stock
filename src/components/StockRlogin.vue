<template>
<div class="users login form">
    <div class="row align-center">
        <img alt="StokR logo" src="../assets/img/logo.png">
    </div>
    <div class="row align-center">
        <h1>StockR</h1>
    </div>
    <form @submit.prevent="login">
      <fieldset>
          <div v-if="hasError" class="callout warning">
            <legend>{{$t("login.error")}}</legend>
        </div>
        <div class="input email required">
          <label for="email">Email</label>
          <input type="email" v-model="email" name="email" required="required" id="email">
        </div>
        <div class="input password required">
          <label for="password">{{$t("login.password")}}</label>
          <input type="password" v-model="password" name="password" required="required" id="password">
        </div>

        <div class="input checkbox">
          <!-- TODO -->
          <label for="remember-me">
            <input type="checkbox" name="remember_me" value="1" checked="checked" id="remember-me">{{$t("login.rememberme")}}
          </label>
        </div>
    </fieldset>

    <div class="row align-center">
      <button class="button" type="submit">{{$t("login.enter")}}</button>
    </div>

    <div class="row align-center">
      <div class="locale-changer">
        <select v-model="$i18n.locale">
          <option v-for="(lang, i) in $i18n.availableLocales" :key="`Lang${i}`" :value="lang">{{ lang }}</option>
        </select>
      </div>
    </div>
  </form>

  <div class="row align-center">
    <!--<a TODO<a href="./users/request-reset-password">Jelszó csere</a>-->
  </div>
</div>
</template>

<script>
import axios from 'axios';
import { required } from 'vuelidate/lib/validators'

export default {
  name: 'StockRlogin',

  data() {
    return {
      email : '',
      password: '',
      user : {},
    }
  },

  validations: {
    email: {required},
    password: {required}
  },

  computed : {
    hasError() {
      return this.email && this.password && !this.$store.state.user;
    }
  },

  methods: {
    async login() {
      console.log('login');
      this.$v.$touch();
      if (!this.$v.$invalid) {
        const qs = require('qs');
        axios({
            method: 'post',
            url: 'http://localhost/~rrd/stockrvue/api/user-get-token.json',
            //withCredentials : true,
            data: qs.stringify({
              email: this.email,
              password: this.password
            })
          })
          .then(resp => {
              this.$store.commit('saveUser',resp.data);
          })
          .catch(err => console.error(err));
      }
    },

    changeLanguage() {
      //i18n.locale = 'en';
    },
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
