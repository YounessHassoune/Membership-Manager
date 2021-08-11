<template>
  <div class="container">
    <BuiDashSidebar />
    <div class="main_container">
      <div class="hb"></div>
    </div>
  </div>
</template>

<script>
import BuiDashSidebar from "../../components/business/BuiDashSidebar.vue";
export default {
  components: { BuiDashSidebar },
};
</script>

<style scoped lang="scss">
@import "../../assets/scss/_placeholders.scss";
@import url("https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i");
.container {
  @extend %container;
  display: flex;
  .main_container {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 25px;
    overflow: auto;
    padding-left: 0;
  }
}
</style>