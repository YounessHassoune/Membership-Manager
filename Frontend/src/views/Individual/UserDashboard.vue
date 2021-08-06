<template>
  <div class="container">
    <UserDashSidebar />
    <div class="main_container">
      <AccountProfile v-if="activetab == 'profile'" />
      <MyPlans v-if="activetab == 'myplans'" />
    </div>
  </div>
</template>

<script>
import UserDashSidebar from "../../components/individual/UserDashSidebar.vue";
import UserDashHeader from "../../components/individual/UserDashHeader.vue";
import AccountProfile from "../../components/individual/AccountProfile.vue";
import MyPlans from "../../components/individual/MyPlans.vue";
import { createNamespacedHelpers } from "vuex";
const { mapState, mapActions } = createNamespacedHelpers("individual");
export default {
  components: { UserDashSidebar, UserDashHeader, AccountProfile, MyPlans },

  data() {
    return {};
  },
  computed: {
    ...mapState({
      activetab: ({ activetab }) => activetab,
    }),
  },
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