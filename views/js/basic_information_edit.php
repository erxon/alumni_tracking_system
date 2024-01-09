<script>
  const basicInformationEdit = document.getElementById("basic-information");
  async function userEditBasicInfo() {
    try {
      await isElementExist(basicInformationEdit);
      basicInformationEdit.addEventListener("submit", (event) => {
        const data = processForm(event);
        const params = `user_id=${data.user_id}&username=${data.username}&first_name=${data.first_name}&last_name=${data.last_name}&email=${data.email}`
        const url = "/thesis/user/edit/basic-information";
        post(url, params);
      });
    } catch (error) {
      console.log(error);
    }
  }
  userEditBasicInfo();
</script>