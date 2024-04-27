<script>
    let alumniId = '';

    function deleteAlumni(alumni, user) {
        alumniId = alumni;
    }

    $("#confirm-delete-alumni").on("click", () => {
        const data = new FormData();

        data.append("id", alumniId);
        data.append("action", "delete-alumni");

        $.ajax({
            type: "POST",
            url: "/thesis/alumni/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                const toast = new bootstrap.Toast("#response");
                if (response.response){
                    $("#toast-body").empty();
                    $("#response").removeClass("text-bg-danger");
                    $("#toast-body").append("Alumni deleted");
                    $("#response").addClass("text-bg-primary");

                    $(`#loading_${alumniId}`).show();
                    $(".alumni-record-action").prop("disabled", true);

                    setInterval(() => {
                        window.location = "/thesis/alumni/index?page=1";
                    }, 3000);
                    
                    toast.show();
                } else {
                    $("#toast-body").empty();
                    $("#response").removeClass("text-bg-primary");
                    $("#toast-body").append("Something went wrong");
                    $("#response").addClass("text-bg-danger");
                    toast.show();
                }
            }
        });
    });
</script>