<template>
  <router-view />
</template>

<script>
export default {
  data() {
    return {};
  },
  created() {
    this.$store.dispatch("individual/getUserInfo");
    this.$store.dispatch("Buissnes/getcompanyinfo");
  },
};
</script>


<style lang="scss">
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
#app {
  // color: #2c3e50;
  // $primary: #9a6dd3;
  // $light_gray: #f7f9fc;
  width: 100vw;
  height: 100vh;
  background-image: linear-gradient(316deg, #c36dd3, #780cfff2);
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}
</style>
