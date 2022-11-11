<?php

require ("register.php");

$json = file_get_contents("php://input");
$body = json_decode($json,true);

$name = $body['name'];
$email = $body['email'];
$password = sha1($body['password']);

$user = new Register;

$user->processUser($name,$email,$password);
echo json_encode("successful");