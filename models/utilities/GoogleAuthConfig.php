<?php

require '/xampp/htdocs/thesis/vendor/autoload.php';

session_start();

$client = new Google\Client();
$client->setAuthConfig('C:/xampp/htdocs/thesis/models/utilities/client_secret_677438672178-v9p9shbh9h7rv78m9vknkapr0spj62tm.apps.googleusercontent.com.json');
$client->addScope(Google\Service\Oauth2::USERINFO_PROFILE);
$client->addScope(Google\Service\Oauth2::USERINFO_EMAIL);
$client->addScope(Google\Service\Oauth2::OPENID);
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/thesis/google_login_callback');
$client->setAccessType('offline');
$client->setIncludeGrantedScopes(true);
$client->setPrompt('select_account');
