<template>
  <div class="container">
    <Navbar />
    <div class="sub-container">
      <div class="left-sub-container">
        <div class="content">
          <p class="head-title">Sign in</p>
          <p class="head-title">to Mange Your Plans</p>
          <p class="sub-title">if you dont have an account</p>
          <p class="sub-title">you can <span>Register here!</span></p>
        </div>
        <div class="img-content">
          <img :src="todolist" alt="" srcset="" />
        </div>
      </div>
      <div class="right-sub-container">
        <Login />
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import Login from "../components/Login.vue";
import todolist from "../assets/img/todolist.svg";
export default {
  components: { Navbar, Login },
  data() {
    return {
      todolist,
    };
  },
};
</script>

<style scoped lang="scss">
@import "../assets/scss/_placeholders.scss";
@import url("https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i");

.container {
  @extend %container;
  .sub-container {
    width: 100%;
    height: calc(100% - 137px);
    display: flex;

    .left-sub-container {
      width: 100%;
      height: 100%;
      font-family: poppins;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      .content {
        width: 65%;
        // background-image: url("../assets/img/back.png");
        // // background-blend-mode: exclusion;
        // background-size: contain;
        // background-repeat: no-repeat;
        // background-position: center;
        // background-blend-mode: soft-light;
        .head-title {
          font-size: 40px;
          font-family: poppins;
          font-weight: 600;
        }
        .sub-title {
          font-weight: 500;
        }
        span {
          color: #3470c2;
          cursor: pointer;
        }
      }
      .img-content {
        width: 100%;
        height: 40%;
        display: flex;
        justify-content: flex-end;
        align-items: center;

        img {
          width: 50%;
          height: 100%;
        }
      }
    }
    .right-sub-container {
      width: 100%;
      height: 100%;
    }
  }
}
</style>