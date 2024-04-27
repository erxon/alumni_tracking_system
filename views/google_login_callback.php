<?php
require "/xampp/htdocs/thesis/models/utilities/GoogleAuthConfig.php";
require "/xampp/htdocs/thesis/models/Database.php";

if (!isset($_GET['code'])) {
  $auth_url = $client->createAuthUrl();
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
  $db = new Database();

  $client->authenticate($_GET['code']);
  $access_token = $client->getAccessToken();
  $user = $user = new Google\Service\Oauth2($client);
  $data = $user->userinfo->get();
  $email = $data["email"];
  $first_name = $data["givenName"];
  $last_name = $data["familyName"];
  $photo = $data["picture"];

  $query = "SELECT * FROM user WHERE email='$email'";
  $result = $db->query($query);

  if ($result->num_rows > 0) {
    $existing_user = $result->fetch_assoc();

    $_SESSION["user_id"] = $existing_user["id"];
    $_SESSION['access_token'] = $client->getAccessToken();
    $_SESSION["first_name"] = $data["givenName"];
    $_SESSION["last_name"] = $data["familyName"];
    $_SESSION["email"] = $data["email"];
    $_SESSION["photo"] = $data["picture"];
    $_SESSION["type"] = $existing_user["type"];

    if ($existing_user["type"] == "alumni") {
      $user_id = $existing_user["id"];
      $getAlumniQuery = "SELECT * FROM alumni WHERE userAccountID='$user_id'";

      $alumni = $db->query($getAlumniQuery)->fetch_assoc();

      $_SESSION["status"] = $alumni["status"];
    }

    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/thesis/home';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  }




}