<?php session_start(); ?>
<?php

include("/xampp/htdocs/thesis/models/Users.php");
$users = new Users();

if (empty($_SESSION["username"])) {
    header("Location: /thesis/home");
    return;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["action"]) && $_POST["action"] == "createUser") {
        $username =  filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);
        $type = filter_input(INPUT_POST, "type", FILTER_DEFAULT);

        $users->createUser(
            $username,
            $first_name,
            $last_name,
            $email,
            $type,
            $password
        );

        header("Location: /thesis/users");
    }
}

include("/xampp/htdocs/thesis/views/template/header.php");
include("/xampp/htdocs/thesis/views/template/admin.php");

?>

<div class="d-flex">
    <div class="users row g-3 m-0 admin-views">
        <div style="border-right: 1px solid #1E1E1E;" class="col-lg-3 col-md-12  px-3">
            <?php include("add.php") ?>
        </div>
        <div class="col-lg-9 col-md-12 px-3">
            <?php include("users.php") ?>
        </div>
    </div>
</div>

<script>
    //user search
    $("#search-user-form").on("submit", (event) => {
        event.preventDefault();

        const data = new FormData(event.target);
        const searchResultContainer = $("#search-user-result-container");
        const searchResultContainerError = $("#search-user-result-container-error");
        //search_user.php

        searchResultContainerError.empty();
        searchResultContainer.empty();
        searchResultContainer.hide();
        $.ajax({
            type: "POST",
            data: data,
            url: "/thesis/admin/user/search",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                const result = JSON.parse(response);
                console.log(result);
                if (!result.success) {
                    searchResultContainerError.fadeIn();
                    searchResultContainerError.append(`
                    <div class="alert alert-danger" role="alert">
                        ${result.message}
                    </div>`);

                    return;
                } else {
                    searchResultContainer.fadeIn();
                    searchResultContainer.append('<p class="text-secondary">Results</p>');
                    result.results.map((user) => {
                        console.log(user);
                        searchResultContainer.append(`
                            <div class='d-flex flex-row align-items-center p-2 border-bottom'>
                                <p style='width: 156px' class='m-0 me-2'>${user[1]}</p>
                                <p style='width: 120px' class='m-0 me-2'>${user[2]}</p>
                                <p style='width: 120px' class='m-0 me-2'>${user[3]}</p>
                                <a role='button' class='btn btn-sm btn-light' href='/thesis/users?id=${user[0]}'>View</a>
                            </div>
                    `);
                    });
                }
            }
        });

        setInterval(() => {
            searchResultContainerError.fadeOut();
        }, 5000);
    });
</script>


<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>