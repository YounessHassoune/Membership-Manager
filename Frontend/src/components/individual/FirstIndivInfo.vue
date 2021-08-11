<template>
  <div class="first-info-container">
    <div class="form-container">
      <div class="input-group">
        <label for="firstname">First Name</label>
        <input
          v-model.trim.lazy="firstname"
          type="text"
          id="firstname"
          name="firstname"
          placeholder="First name"
        />
      </div>
      <div class="input-group">
        <label for="lastname">Last Name</label>
        <input
          v-model.trim.lazy="lastname"
          type="text"
          id="lastname"
          name="lastname"
          placeholder="Last name"
        />
      </div>
      <div class="input-group">
        <label for="cin">ID</label>
        <input
          v-model.trim.lazy="cin"
          type="text"
          id="cin"
          name="cin"
          placeholder="National ID card"
        />
      </div>
      <div class="input-group">
        <label for="birth">Date of Birth</label>
        <input v-model.trim="birth" type="date" id="birth" name="birth" />
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
  name: "FirstIndivInfo",
  data() {
    return {
      firstname: "",
      lastname: "",
      cin: "",
      birth: "",
    };
  },
  watch: {
    ...mapActions([
      "individual/updatefirstname",
      "individual/updatelastname",
      "individual/updatecin",
      "individual/updatebirth",
    ]),
    firstname(value) {
      this.firstname = value;
      this.$store.dispatch("individual/updatefirstname", this.firstname);
    },
    lastname(value) {
      this.lastname = value;
      this.$store.dispatch("individual/updatelastname", this.lastname);
    },
    cin(value) {
      this.cin = value;
      this.$store.dispatch("individual/updatecin", this.cin);
    },
    birth(value) {
      this.birth = value;
      this.$store.dispatch("individual/updatebirth", this.birth);
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