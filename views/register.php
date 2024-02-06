<?php session_start(); ?>
<?php
require("/xampp/htdocs/thesis/models/Authentication.php");

$auth = new Authentication();
$message;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);

    try {
        $auth->login($username, $password);
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<?php
if (isset($_SESSION["username"])) {
    header("Location: /thesis/home");
} else {
    include("/xampp/htdocs/thesis/views/template/header.php");
?>

    <div class="bg-white rounded shadow-sm user-register">
        <div>
            <div class="p-4 text-center">
                <p class="mb-0">Alumni Tracking System</p>
                <h2 class="mb-3">Signup</h2>
                <form method="post">
                    <div class="d-flex mb-2">
                        <div class="form-floating flex-fill me-1">
                            <input id="floatingInput" class="form-control" type="text" placeholder="First name" name="firstName">
                            <label for="floatingInput">First name</label>
                        </div>
                        <div class="form-floating flex-fill">
                            <input id="floatingInput" class="form-control" type="text" placeholder="Last name" name="lastName">
                            <label for="floatingInput">Last name</label>
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input id="floatingInput" class="form-control" type="text" placeholder="email" name="email">
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input id="floatingInput" class="form-control" type="text" placeholder="username" name="username">
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" type="text" placeholder="password" name="password" />
                        <label for="floatingInput">Password</label>
                    </div>
                    <div class="d-grid gap-2 mx-auto text-center">
                        <button class="btn btn-primary mt-3 " type="submit">Signup</button>
                        <p style="font-size: 14px;">Already have an account? <a href="/thesis/login">Login here</a></p>
                    </div>
                </form>
            </div>
        </div>

        <?php if (isset($message)) { ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $message; ?>
            </div>
        <?php } ?>
    </div>

<?php } ?>
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>