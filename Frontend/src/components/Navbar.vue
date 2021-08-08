<template>
  <nav>
    <ul>
      <div class="nav-1">
        <li>
          <a href="#" id="logo"><img :src="logo" alt="" /></a>
        </li>
      </div>
      <div class="nav-2">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
      </div>
      <div class="nav-3">
        <button v-if="logged == false">Log in</button>
        <button v-if="logged == false" @click="register" class="active">Register</button>
      </div>
    </ul>
  </nav>
</template>

<script>
import logo from "../assets/img/logo.png";
import router from "../router";
import { mapState, mapActions, mapGetters } from "vuex";
export default {
  name: "Navbar",

  data() {
    return { logo };
  },
  methods: {
    register() {
      router.push({ name: "Register" });
    },
  },
  computed: {
    ...mapState({
      logged: (state) => state.individual.logged,
    }),
  },
};
</script>

<style scoped lang="scss">
@import "../assets/scss/_variabales.scss";
@import url("https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i");

nav {
  width: 100%;
  top: 0;
  overflow: hidden;

  ul {
    list-style-type: none;
    margin: 0;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: space-around;

    .nav-1 {
      #logo {
        img {
          width: 100px;
          height: 100px;
          padding: 0;
        }
      }
    }

    .nav-3 {
      button {
        background-color: transparent;
        border: none;
        font-size: 17px;
        font-family: poppins;
        padding: 10px 20px;
        cursor: pointer;
      }
      .active {
        background-color: $primary;
        border-radius: 30px;
        color: white;
      }
    }

    li {
      display: inline;
      font-family: poppins;
      font-size: 17px;
      a {
        color: black;
        text-decoration: none;
        padding: 14px;
      }
    }
  }
}
</style>