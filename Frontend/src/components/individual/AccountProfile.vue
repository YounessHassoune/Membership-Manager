<template>
  <div class="account-profile">
    <div class="wall-img">
      <div class="wall-overlay">
        <h1>
          Hello {{ indivInfo.user_firstname + " " + indivInfo.user_lastname }}
        </h1>
      </div>
    </div>
    <div class="account-info">
      <div class="edit-section">
        <div class="header">
          <p>My account</p>
        </div>
        <div class="info-editing">
          <div class="form-container">
            <div class="input-group">
              <label for="firstname">First Name</label>
              <input
                :value="indivInfo.user_firstname"
                type="text"
                id="firstname"
                name="firstname"
                placeholder="First name"
                disabled
              />
            </div>
            <div class="input-group">
              <label for="lastname">Last Name</label>
              <input
                :value="indivInfo.user_lastname"
                type="text"
                id="lastname"
                name="lastname"
                placeholder="Last name"
                disabled
              />
            </div>
            <div class="input-group">
              <label for="cin">ID</label>
              <input
                :value="indivInfo.user_cin"
                type="text"
                id="cin"
                name="cin"
                placeholder="National ID card"
                disabled
              />
            </div>
            <div class="input-group">
              <label for="birth">Date of Birth</label>
              <input
                :value="indivInfo.user_birth"
                type="date"
                id="birth"
                name="birth"
                disabled
              />
            </div>
            <div class="input-group">
              <label for="phone">Phone Number</label>
              <input
                :value="indivInfo.user_phone"
                type="text"
                id="phone"
                name="phone"
                placeholder="Phone number"
                disabled
              />
            </div>
            <div class="input-group">
              <label for="email">Email</label>
              <input
                :value="indivInfo.user_email"
                type="email"
                id="email"
                name="email"
                placeholder="type your email"
                disabled
              />
            </div>

            <div class="input-group image-input">
              <label for="image" class="label-upload">{{
                FileImageName
              }}</label>
              <input
                @change="displaImageName"
                type="file"
                id="image"
                name="image"
                accept="image/jpg,image/jpeg"
                max-file-size="5000000"
                class="custom-file-input"
                disabled
              />
            </div>
          </div>
        </div>
        <div class="btns">
          <button @click="edit" class="cancel-btn">edit</button>
          <button @click="savechanges" class="continue-btn">
            Save Changes
          </button>
        </div>
      </div>
      <div class="card-section">
        <div class="profile-img">
          <img
            :src="
              indivInfo.user_image
                ? 'http://localhost/Membership-Manager/Backend/public/storage/images/' +
                  indivInfo.user_image
                : img
            "
          />
        </div>
        <div class="profile-info">
          <p class="name">
            {{ indivInfo.user_firstname + " " + indivInfo.user_lastname }}
          </p>
          <p class="adresse">{{ indivInfo.user_birth }}</p>
          <p class="adresse">
            {{ indivInfo.user_email }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import img from "../../assets/img/img.jpg";
import { createNamespacedHelpers } from "vuex";
const { mapState, mapActions } = createNamespacedHelpers("individual");

export default {
  data() {
    return {
      FileImageName: "Profile Image",
      img,
      arr: [],
    };
  },
  computed: {
    ...mapState({
      logged: ({ logged }) => logged,
      indivInfo: ({ indivInfo }) => indivInfo,
    }),
  },
  methods: {
    ...mapActions(["individual/getUserInfo"]),
    displaImageName(e) {
      if (e.target.files[0]) {
        this.FileImageName = e.target.files[0].name;
        this.image = e.target.files[0];
      } else {
        this.FileImageName = "Profile Image";
      }
    },
    edit() {
      let firstname = document.getElementById("firstname");
      let lastname = document.getElementById("lastname");
      let cin = document.getElementById("cin");
      let birth = document.getElementById("birth");
      let phone = document.getElementById("phone");
      let email = document.getElementById("email");
      this.arr.push(firstname);
      this.arr.push(lastname);
      this.arr.push(cin);
      this.arr.push(birth);
      this.arr.push(phone);
      this.arr.push(email);
      this.arr.push(image);
      this.arr.forEach((e) => {
        e.disabled = false;
        e.style.borderColor = "#9a6dd3";
      });
    },
    async savechanges() {
      if (this.arr.length > 0) {
        this.arr.forEach((e) => {
          e.disabled = true;
          e.style.borderColor = "transparent";
        });
        let updateinfo = {
          firstname: this.arr[0].value.trim(),
          lastname: this.arr[1].value.trim(),
          cin: this.arr[2].value.trim(),
          birth: this.arr[3].value.trim(),
          phone: this.arr[4].value.trim(),
          email: this.arr[5].value.trim(),
        };
        console.log(updateinfo);

        let formdata = new FormData();
        if (this.arr[6].files[0]) {
          formdata.append("image", this.arr[6].files[0]);
          console.log(this.arr[6].files[0]);
        }
        let info = JSON.stringify(updateinfo);
        formdata.append("request", info);
        let result = await fetch(
          "http://localhost/Membership-Manager/Backend/user/update",
          {
            method: "POST",
            body: formdata,
            headers: {
              Authorization: `Bearer ${localStorage.getItem("indiv_token")}`,
            },
          }
        );
        let response = await result.json();
        console.log(response);
        if (response.updated == true) {
          this.$store.dispatch("individual/getUserInfo");
        } else {
          this.$store.dispatch("individual/getUserInfo");
        }
      }
    },
  },
};
</script>

<style scoped lang="scss">
@import "../../assets/scss/_variabales.scss";

.account-profile {
  width: 90%;
  overflow-y: auto;

  .wall-img {
    width: 100%;
    height: 200px;
    border-radius: 8px;
    z-index: 0;
    background-image: url("../../assets/img/wall.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    // position: relative;
    .wall-overlay {
      width: 100%;
      height: 200px;
      border-radius: 8px;
      font-family: poppins;
      z-index: -1;
      backdrop-filter: brightness(60%);
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
    }
  }
  .account-info {
    width: 100%;
    margin-top: -50px;
    display: flex;
    justify-content: space-around;

    .edit-section {
      width: 50%;
      z-index: 10;
      background-color: white;
      border-radius: 8px;
      height: 600px;
      box-shadow: 0 0 25px 0 rgb(0, 0, 0, 0.15);
      margin-bottom: 10px;
      display: flex;
      flex-direction: column;
      font-family: poppins;
      position: relative;
      .header {
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;

        p {
          font-size: 17px;
          font-weight: 500;
        }
      }
      .info-editing {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 470px;
        background-color: #f7f9fc;
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
              color: rgb(61, 61, 61);
              margin-bottom: 5px;
            }
            input {
              height: 60px;
              border-radius: 10px;
              border: solid 1px white;
              background-color: white;
              padding-left: 20px;
              font-family: poppins;
              color: rgb(87, 87, 87);

              &:focus {
                outline: none;
              }
            }
            input[type="file"] {
              display: none;
            }
            .label-upload {
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

              background-color: white;
            }
          }
          .image-input {
            width: 80%;
          }
        }
      }
      .btns {
        height: 80px;
        width: 90%;
        background-color: white;
        bottom: 0;
        left: 0;
        position: absolute;
        display: flex;
        justify-content: flex-end;
        align-items: center;

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
    .card-section {
      width: 30%;
      z-index: 10;
      border-radius: 8px;
      background-color: white;
      box-shadow: 0 0 25px 0 rgb(0, 0, 0, 0.15);
      height: 400px;
      display: flex;
      flex-direction: column;
      align-items: center;
      .profile-img {
        display: flex;
        justify-content: center;
        margin-top: -70px;
        width: 200px;
        height: 200px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        overflow: hidden;
        img {
          width: 100%;
          object-fit: cover;
        }
      }
      .profile-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        .name {
          margin-top: 20px;
          font-family: poppins;
          font-weight: 500;
          font-size: 20px;
          .age {
            font-size: 20px;
            font-weight: 300;
          }
        }
        .adresse {
          margin-top: 20px;
          width: 50%;
          font-family: poppins;
          font-size: 14px;
          text-align: center;
        }
      }
    }
  }
}
</style>