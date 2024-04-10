<script>
    $("#new-gallery").on("keyup", (event) => {
        if (event.target.value !== ""){
            $("#add-gallery-button").prop("disabled", false);
        } else {
            $("#add-gallery-button").prop("disabled", true);
        }
    })
</script>