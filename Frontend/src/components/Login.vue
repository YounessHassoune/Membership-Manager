<template>
  <div class="login-container">
    <p>Log in</p>
    <div class="form-container">
      <div class="input-group">
        <label for="email">E-mail</label>
        <input
          type="text"
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
        />
      </div>
      
      <button>Log in</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      value: "",
    };
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
}
</style>