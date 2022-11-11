<?php 
require("user.php");

$json = file_get_contents('php://input');


$body = json_decode($json, true);
// echo json_encode(($body)); exit;


$name = $body['name'];
$address = $body['address'];
$email = $body['email'];
$occupation = $body['occupation'];
$gender = $body['gender'];

// $name = $_REQUEST['name'];
// $address = $_REQUEST['address'];
// $email = $_REQUEST['email'];
// $occupation = $_REQUEST['occupation'];
// $gender = $_REQUEST['gender'];

$user = new User;

$user->processUser($name,$address,$email,$occupation,$gender);
echo json_encode("saved successfully");
?>