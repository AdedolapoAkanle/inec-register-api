<?php

require("login.php");

$json = file_get_contents("php://input");
$body = json_decode($json,true);


$email = $body['email'];
$password = $body['password'];

$user = new Login;

$processed = $user->processUserSignIn($email, $password);
echo json_encode($processed);