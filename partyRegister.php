<?php 
require("party.php");

$json = file_get_contents('php://input');

$body = json_decode($json, true);
echo json_encode($body); exit;

// $name = $body['name'];
// $color = $body['color'];
// $slogan = $body['slogan'];
// $image = $body['image'];

$name = $_REQUEST['name'];
$color = $_REQUEST['color'];
$slogan = $_REQUEST['slogan'];
$image = $_REQUEST['image'];

$user = new Party;

$user->processParty($name,$color,$slogan,$image);
echo json_encode("saved successfully");
?>