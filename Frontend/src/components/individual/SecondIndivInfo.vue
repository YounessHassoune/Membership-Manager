<template>
  <div class="first-info-container">
    <div class="form-container">
      <div class="input-group">
        <label for="phone">Phone Number</label>
        <input
          v-model.trim.lazy="phone"
          type="text"
          id="phone"
          name="phone"
          placeholder="Phone number"
        />
      </div>
      <div class="input-group">
        <label for="email">Email</label>
        <input
          v-model.trim.lazy="email"
          type="email"
          id="email"
          name="email"
          placeholder="type your email"
        />
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input
          v-model.trim.lazy="password"
          type="password"
          id="password"
          name="password"
          placeholder="type your password"
        />
      </div>
      <div class="input-group">
        <label for="image" class="label-upload">{{ FileImageName }}</label>
        <input
          @change="displaImageName"
          type="file"
          id="image"
          name="image"
          accept="image/jpg,image/jpeg"
          max-file-size="5000000"
          class="custom-file-input"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
  name: "SecondIndivInfo",
  data() {
    return {
      FileImageName: "Profile Image",
      phone: "",
      email: "",
      password: "",
      image: "",
    };
  },
  computed: {
    ...mapState({
      registerinfo: (state) => state.individual.registerinfo,
    }),
  },
  methods: {
    displaImageName(e) {
      if (e.target.files[0]) {
        this.FileImageName = e.target.files[0].name;
        this.image = e.target.files[0];
        this.$store.dispatch("individual/updateimage", this.image);
      } else {
        this.FileImageName = "Profile Image";
        this.$store.dispatch("individual/updateimage", null);
      }
    },
  },
  watch: {
    ...mapActions([
      "individual/updatemail",
      "individual/updatephone",
      "individual/updatepassword",
      "individual/updateimage",
    ]),
    phone(value) {
      this.phone = value;
      this.$store.dispatch("individual/updatephone", this.phone);
    },
    email(value) {
      this.email = value;
      this.$store.dispatch("individual/updatemail", this.email);
    },
    password(value) {
      this.password = value;
      this.$store.dispatch("individual/updatepassword", this.password);
    },
  },
};
</script>

<style scoped lang="scss">
.first-info-container {
  width: 100%;
  height: 100%;
  background-color: white;
  display: flex;
  justify-content: center;
  align-items: center;

  .form-container {
    width: 80%;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    .input-group {
      width: 40%;
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
      input[type="file"] {
        display: none;
      }
      .label-upload {
        border: solid 1px #d4dae8;
        overflow: hidden;
        font-family: poppins;
        width: 100%;
        height: 60px;
        margin-bottom: 0;
        display: flex;
        text-align: center;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        margin-top: 30px;
        background-color: #f7f9fc;
      }
    }
    button {
      background-color: white;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 17px;
      height: 60px;
      cursor: pointer;
    }
  }
}
</style>