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

  <div class="login-form bg-white rounded shadow-sm p-2">
    <div class="g-0">
      <div class="d-flex align-items-center">
        <img style="object-fit: cover; width: 200px; height: 200px;" class="mx-auto" src="/thesis/public/assets/login-form.png" />
      </div>
      <div class="p-4 w-50 mx-auto">
        <p class="mb-0 text-center">Alumni Tracking System</p>
        <h2 class="mb-3 text-center">Login</h2>
        <div class="d-grid gap-2">
          <a role="button" class="btn btn-outline-dark" href="/thesis/google_login"><i class="fab fa-google"></i> Continue
            with Google</a>
          <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#termsAndConditions">Register here</button>
        </div>
      </div>
    </div>

    <?php if (isset($message)) { ?>
      <div class="alert alert-danger mt-3" role="alert">
        <?php echo $message; ?>
      </div>
    <?php } ?>
  </div>

<?php } ?>

<?php include "/xampp/htdocs/thesis/views/home/alumni_registration_modal.php"; ?>
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>