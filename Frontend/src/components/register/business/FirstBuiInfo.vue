<template>
  <div class="first-info-container">
    <div class="form-container">
      <div class="input-group">
        <label for="companyname">Company Name</label>
        <input
          type="text"
          id="companyname"
          name="companyname"
          placeholder="Company name"
        />
      </div>
      <div class="input-group">
        <label for="about">About</label>
        <textarea id="about" name="about" placeholder="About" />
      </div>
      <div class="input-group">
        <label for="adres-bui">Address</label>
        <input type="text" id="adress" name="adress" placeholder="Address" />
      </div>
      <div class="input-group">
        <label for="city">City</label>
        <input type="text" id="city" name="city" placeholder="city" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FirstBuiInfo",
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
      textarea {
        height: 60px;
        border-radius: 10px;
        border: solid 1px #d4dae8;
        background-color: #f7f9fc;
        padding-left: 20px;
        padding-top: 20px;
        padding-right: 20px;
        font-family: poppins;
        resize: none;

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