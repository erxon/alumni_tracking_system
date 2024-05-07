<script>
    $("#curriculum-exit-mid-level-skills-development").on("submit", (event) => {
        event.preventDefault();
        const formData = new FormData(event.target);

        formData.append("alumniID", <?php echo $id ?>);
        formData.append("toEdit", "curriculum-exit-mid-level-skills-development")

        $.ajax({
            type: "POST",
            url: "/thesis/alumni/edit/server",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                const parsedResponse = JSON.parse(response);

                const successToast = new bootstrap.Toast("#response");
                const errorToast = new bootstrap.Toast("#error-response");

                if (parsedResponse.response) {
                    $("#toast-body").append("Sucessfully saved");
                    $("#response").addClass("text-bg-success");
                    successToast.show();
                } else {
                    $("#error-response #toast-body").append("Something went wrong");

                    errorToast.show();
                }
            }
        })
    });
</script>