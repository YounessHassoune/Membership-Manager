<template>
  <div class="container">
    <div class="sub-container">
      <div class="header">
        <img :src="logo" alt="" />
        <div v-if="profile != 0" class="setup">
          <span>setup {{ choice }} account : </span
          ><span>{{ Math.abs(profile) }}/2</span>
        </div>
      </div>
      <div class="profile">
        <div v-if="profile == 0">
          <div class="radio-btns">
            <div>
              <input
                type="radio"
                name="profile"
                value="Business"
                class="radio-expand"
                id="Business"
                v-model="choice"
              />
              <label for="Business">Business</label>
            </div>
            <div>
              <input
                type="radio"
                name="profile"
                value="Individual"
                class="radio-expand"
                id="Individual"
                v-model="choice"
              />
              <label for="Individual">Individual</label>
            </div>
          </div>
          <div class="imgs">
            <img :src="buiss" alt="" />
            <img :src="indiv" alt="" />
          </div>
        </div>
        <FirstIndivInfo v-if="profile == 1" />
        <SecondIndivInfo v-if="profile == 2" />
        <FirstBuiInfo v-if="profile == -1" />
        <SecondBuiInfo o v-if="profile == -2" />
      </div>
      <div class="footer">
        <button @click="back" class="cancel-btn">Back</button>
        <button @click="next" class="continue-btn">Continue</button>
      </div>
    </div>
  </div>
</template>

<script>
import router from "../router";
import logo from "../assets/img/logo.png";
import indiv from "../assets/img/indiv.svg";
import buiss from "../assets/img/buiss.svg";
import FirstIndivInfo from "../components/individual/FirstIndivInfo.vue";
import SecondIndivInfo from "../components/individual/SecondIndivInfo.vue";
import FirstBuiInfo from "../components/business/FirstBuiInfo.vue";
import SecondBuiInfo from "../components/business/SecondBuiInfo.vue";
export default {
  components: { FirstIndivInfo, SecondIndivInfo, FirstBuiInfo, SecondBuiInfo },
  data() {
    return { logo, indiv, buiss, profile: 0, choice: "", info: {} };
  },

  methods: {
    next() {
      if (this.profile < 2 && this.profile > -2) {
        if (this.choice != "" && this.choice == "Individual") {
          this.profile++;
        } else if (this.choice != "" && this.choice == "Business") {
          this.profile -= 1;
        }
      }
    },
    back() {
      if (this.profile == 0) {
        router.push({ name: "Home" });
      }
      if (this.choice != "" && this.choice == "Individual") {
        this.profile--;
      } else if (this.choice != "" && this.choice == "Business") {
        this.profile += 1;
      }
    },
    register_info(info) {},
  },
};
</script>

<style scoped lang="scss">
@import "../assets/scss/_placeholders.scss";
@import "../assets/scss/_variabales.scss";
.container {
  font-family: poppins;
  @extend %container;
  display: flex;
  justify-content: center;
  align-items: center;
  .sub-container {
    width: 60%;
    height: 80%;
    box-shadow: 0 0 25px 0 rgb(0, 0, 0, 0.15);
    background-color: rgb(255, 255, 255);
    border-radius: 20px;
    .header {
      width: 100%;
      height: 20%;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      img {
        width: 18%;
        margin-bottom: 0;
      }
      p {
        margin-top: 0;
        font-size: 15px;
        // font-weight: 500;
      }
    }
    .profile {
      width: 100%;
      height: 70%;
      .radio-btns {
        padding-top: 50px;
        width: 100%;
        height: 20%;
        display: flex;
        justify-content: space-around;
        align-items: baseline;
        gap: 10px;
        label {
          font-size: 20px;
          font-weight: 500;
          margin-left: 5px;
        }
      }
      .imgs {
        width: 100%;
        height: fit-content;
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-top: 30px;
        img {
          width: 25%;
        }
      }
    }
    .footer {
      width: 90%;

      display: flex;
      justify-content: flex-end;
      align-items: center;
      //   gap: 30px;
      padding-right: 30px;
      .continue-btn {
        background-color: $primary;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        padding: 15px 40px;
        cursor: pointer;
      }
      .cancel-btn {
        background-color: transparent;
        color: $primary;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        padding: 15px 40px;
        cursor: pointer;
      }
    }
  }
}
</style>