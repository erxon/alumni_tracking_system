<?php

require "/xampp/htdocs/thesis/models/utilities/GoogleAuthConfig.php";

//check if the user already exist
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
    $user = new Google\Service\Oauth2($client);
    $data = $user->userinfo->get();
    print_r($_SESSION);
    echo json_encode($data);
} else {
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/thesis/google_login_callback';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

//if the user is in the database, login the user
