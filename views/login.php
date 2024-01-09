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

  <div class="login-form">
    <p class="mb-0">Alumni Tracking System</p>
    <h2 class="mb-3">Please Login</h2>
    <form method="post">
      <div class="form-floating">
        <input id="floatingInput" class="form-control username" type="text" placeholder="username" name="username">
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control password" type="text" placeholder="password" name="password" />
        <label for="floatingInput">Password</label>
      </div>
      <div class="d-grid gap-2 mx-auto text-center">
        <button class="btn btn-primary mt-3 " type="submit">Login</button>
        <?php if (isset($message)) { ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $message; ?>
          </div>
        <?php } ?>
      </div>
    </form>
  </div>
<?php } ?>
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>