<?php session_start(); ?>

<?php
require("/xampp/htdocs/thesis/models/Users.php");

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_URL);

$user = new Users();

$result = $user->getUserById($id);

if (isset($result)) {
    $rows = $result->fetch_assoc();
}
?>

<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>
<div class="main-body-padding" style="margin-top: 5%">
    <div class="bg-white rounded shadow w-50 container-fluid p-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=<?php echo "/thesis/user/index" ?>>Profile</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div>
            <!--Basic information-->
            <div class="mb-3">
                <?php include("/xampp/htdocs/thesis/views/users/edit_user/basic_information.php"); ?>
            </div>
        </div>
    </div>
</div>
<script>
    function toastShow(color, message) {
        $("#toast-body").empty();

        if (color === "text-bg-danger") {
            $("#response").removeClass("text-bg-primary");
        } else {
            $("#response").removeClass("text-bg-danger");
        }

        const toast = new bootstrap.Toast("#response");
        $("#toast-body").append(message);
        $("#response").addClass(color);

        toast.show();
    }

    let viewCurrentPassword = false;
    let viewNewPassword = false;

    $("#password").on("keyup", (event) => {

        if (event.target.value !== "") {
            $("#view-current-password").prop("disabled", false);
        } else {
            $("#view-current-password").prop("disabled", true);
        }

    });
    $("#new-password").on("keyup", (event) => {

        if (event.target.value !== "") {
            $("#view-new-password").prop("disabled", false);
        } else {
            $("#view-new-password").prop("disabled", true);
        }

    });

    $("#view-current-password").on("click", () => {
        viewCurrentPassword = !viewCurrentPassword;

        if (viewCurrentPassword) {
            $("#password").prop("type", "text");
            $("#view-current-password").empty();
            $("#view-current-password").append(`<i class="fas fa-eye-slash"></i>`);
        } else {
            $("#password").prop("type", "password");
            $("#view-current-password").empty();
            $("#view-current-password").append(`<i class="fas fa-eye"></i>`);
        }
    });

    $("#view-new-password").on("click", () => {
        viewNewPassword = !viewNewPassword;

        if (viewNewPassword) {
            $("#new-password").prop("type", "text");
            $("#view-new-password").empty();
            $("#view-new-password").append(`<i class="fas fa-eye-slash"></i>`);
        } else {
            $("#new-password").prop("type", "password");
            $("#view-new-password").empty();
            $("#view-new-password").append(`<i class="fas fa-eye"></i>`);
        }
    });

    $("#change-password").on("submit", event => {
        event.preventDefault();
        console.log(event)

        const userId = $("#user-id").val();
        const data = new FormData(event.target);

        data.append("action", "edit-user-password");
        data.append("id", userId);

        $.ajax({
            type: "POST",
            url: "/thesis/users/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (response.response === true) {
                    toastShow("text-bg-primary", "Password changed");
                    $("#password").val("");
                    $("#new-password").val("");
                } else {
                    toastShow("text-bg-danger", response.response);
                }
            }
        });
    });

    $("#email").on("keyup", (event) => {
        console.log(event.target.value);
        const sessionEmail = "<?php echo $_SESSION["email"] ?>"

        console.log(sessionEmail)
        if (event.target.value !== sessionEmail) {
            $("#save-email").prop("disabled", false);
        } else {
            $("#save-email").prop("disabled", true);
        }
    });

    $("#basic-information").on("submit", (event) => {
        event.preventDefault();

        const userId = $("#user-id").val();

        const data = new FormData(event.target);
        data.append("action", "edit-user-basic-information");
        data.append("id", userId);

        $.ajax({
            type: "POST",
            url: "/thesis/users/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (typeof(response.response) === "boolean" && response.response) {
                    toastShow("text-bg-primary", "User updated");
                } else {
                    toastShow("text-bg-danger", response.response);
                }
            }
        });
    });
</script>
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>