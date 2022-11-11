<?php
require("user.php");
        
$json = file_get_contents('php://input');

$body = json_decode($json, true); 

$id = $body['id'];
$name = $body['name'];
$address = $body['address'];
$occupation = $body['occupation'];
$gender = $body['gender'];

$user = new User;

$user->processNewUser($id, $name, $address, $occupation, $gender);
echo json_encode("update successful");

?>