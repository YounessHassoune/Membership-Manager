<template>
  <div class="container">
    <div class="sub-container"></div>
  </div>
</template>

<script>
import Notfound from "../assets/img/404.svg";
export default {
  data() {
    return {
      Notfound,
    };
  },
};
</script>

<style scoped lang="scss">
@import "../assets/scss/_placeholders.scss";
.container {
  @extend %container;
  background-image: url("../assets/img/404.svg");
  background-size: 50%;
  background-repeat: no-repeat;
  background-position: center;
}
</style>