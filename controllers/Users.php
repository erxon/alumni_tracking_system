<?php 

$username = filter_input(INPUT_POST, "username", FILTER_DEFAULT);
$first_name = filter_input(INPUT_POST, "first_name", FILTER_DEFAULT);
$last_name = filter_input(INPUT_POST, "last_name", FILTER_DEFAULT);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, "email", FILTER_DEFAULT);

echo "username: $username";
echo "first_name: $first_name";
echo "last_name: $last_name";
echo "email: $email";
echo "password: $password";
