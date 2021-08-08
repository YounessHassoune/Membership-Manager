<template>
  <div class="login-container">
    <p>Log in</p>
    <div class="form-container">
      <div class="input-group">
        <label for="email">E-mail</label>
        <input
          v-model.trim="email"
          type="email"
          id="email"
          name="email"
          placeholder="example@gmail.com"
        />
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Type your password"
          v-model.trim="password"
        />
      </div>
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
      <button @click="login">Log in</button>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import router from "../router";
export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
      choice: "",
    };
  },
  methods: {
    ...mapActions([
      "individual/changeloginstatus",
      "individual/updateIndivInfo",
    ]),
    async login() {
      if (this.choice == "" || this.email == "" || this.password == "") {
        console.log("empty inputs");
      } else {
        if (this.choice == "Individual") {
          let login_info = {
            email: this.email,
            password: this.password,
          };
          let result = await fetch(
            "http://localhost/Membership-Manager/Backend/user/login",
            {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify(login_info),
            }
          );
          let response = await result.json();
          console.log(response);
          if (response.token) {
            localStorage.setItem("indiv_token", response.token);
            this.$store.dispatch("individual/changeloginstatus", true);
            this.$store.dispatch("individual/updateIndivInfo", response.user);
            router.push("UserDashboard");
          } else {
            this.$swal("", "login info is incorect!", "error");
          }
        } else if (this.choice == "Business") {
          let login_info = {
            email: this.email,
            password: this.password,
          };
          let result = await fetch(
            "http://localhost/Membership-Manager/Backend/company/login",
            {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify(login_info),
            }
          );
          let response = await result.json();
          console.log(response);
          if (response.token) {
            localStorage.setItem("buiss_token", response.token);
            this.$store.dispatch("Buissnes/changeloginstatus", true);
            this.$store.dispatch("Buissnes/updateComInfo", response.user);
            router.push("BuisnessDashboard");
          } else {
            this.$swal("", "login info is incorect!", "error");
          }
        }
      }
    },
  },
};
</script>

<style scoped lang="scss">
@import "../assets/scss/_variabales.scss";

@import url("https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i");

.login-container {
  width: 100%;
  height: 100%;
  font-family: poppins;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  p {
    font-size: 25px;
    margin-bottom: 20px;
    font-weight: 500;
  }
  .form-container {
    width: 60%;
    height: 70%;
    display: flex;
    flex-direction: column;
    gap: 50px;
    .input-group {
      display: flex;
      flex-direction: column;
      label {
        font-family: poppins;
        font-weight: 400;
        color: rgb(87, 87, 87);
        margin-bottom: 5px;
      }
      input {
        height: 60px;
        border-radius: 10px;
        border: solid 1px #d4dae8;
        background-color: #f7f9fc;
        padding-left: 20px;
        font-family: poppins;

        &:focus {
          outline: none;
        }
      }
    }
    button {
      background-color: $primary;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 17px;
      height: 60px;
      cursor: pointer;
    }
  }
  .radio-btns {
    width: 100%;
    display: flex;
    justify-content: space-around;
  }
}
</style>