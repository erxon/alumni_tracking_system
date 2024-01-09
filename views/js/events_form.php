<script>
    document.getElementById("events-form")
        .addEventListener("submit", (event) => {
            event.preventDefault();
            document.getElementById("events-form").classList.add("was-validated");

        })
</script>