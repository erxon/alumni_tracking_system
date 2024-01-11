$("#content-categories").on("change", (event) => {
  if(event.target.value == "events"){
    $.ajax({
        type: "GET",
        url: "/thesis/contents/events",
        success: (response) => {
            console.log(response)
            $("#contents-container").html(response)
        }
    })
  }
});
