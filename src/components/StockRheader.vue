<template>
    <header>
      <nav>
        <!--
          TODO responsive menu
        <div class="title-bar" data-responsive-toggle="navbar" data-hide-for="medium">
            <button class="menu-icon" type="button" data-toggle="navbar"></button>
            <div class="title-bar-title">Menu</div>
        </div>
        -->

        <div data-sticky-container>
            <div class="top-bar" id="navbar" data-sticky data-options="marginTop:0;" style="width:100%">
                <div class="top-bar-left">
                   <ul class="dropdown menu" data-dropdown-menu>
                        <li><img alt="StokR logo" src="../assets/img/logo.png"></li>
                        <li><router-link :to="`/${$i18n.locale}/`"><i class="fi-home"> Főoldal</i></router-link></li>
                        <li><router-link to="/todo"><i class="fi-book"> Bizonylatok</i></router-link></li>
                        <li><router-link to="/todo"><i class="fi-list-thumbnails"> Készlet</i></router-link></li>
                        <li><router-link to="/todo"><i class="fi-upload"> Import</i></router-link></li>
                        <li>
                          <router-link to="/todo"><i class="fi-widget"> Törzsadat</i></router-link>
                          <ul class="nested vertical menu">
                            <li><router-link to="/todo"><i class="fi-torso-business"> Cégek</i></router-link></li>
                          </ul>
                        </li>
                        <li><router-link :to="`/${$i18n.locale}/about`">About</router-link></li>
                   </ul>
                </div>

                <div class="top-bar-right">
                    <ul class="menu">
                      <li><router-link to="/todo"><i class="fi-torso"> TODO COMPANY</i></router-link></li>
                      <li><a href="/" @click.prevent="logout" title="logout">{{this.$store.state.user.email}} <i class="fi-power"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
      </nav>
    </header>
</template>

<script>
export default {
  name: 'StockrHeader',

  methods: {
    logout() {
      this.$store.commit('removeUser');
    }
  }
}
</script>

<style scoped>
header {
  text-align: center;
}

header a {
  font-weight: bold;
}

header a.router-link-exact-active {
  background-color: #2c83b6;
  color: #fff;
}

.top-bar ul, .top-bar {
    background-color: #fff
}

ul.dropdown li {
    margin: 0 .2em;
}

.top-bar a:hover {
    background-color: #2c83b6;
    color: #fff;
    transition: background .5s, color .5s;
}
</style>