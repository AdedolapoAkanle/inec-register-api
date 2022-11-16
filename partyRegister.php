<?php 
require("party.php");

$json = file_get_contents('php://input');
$body = json_decode($json, true);
// error_reporting(0);

// $name = $_REQUEST['name'];
// $color = $_REQUEST['color'];
// $slogan = $_REQUEST['slogan'];
// $image = $_REQUEST['image'];

$name = $body['partyName'];
$color = $body['partyColor'];
$slogan = $body['partySlogan'];
$image = $body['partyImage'];

$filename = $_FILES["partyImage"]["name"];
$temp_name = $_FILES["partyImage"]["tmp_name"];
$folder = "images" . $filename;

// echo json_encode($body);exit;

if (move_uploaded_file($temp_name, $folder)) {
    echo json_encode("successful");
} else {
    echo json_encode("failed");
}
    
$user = new Party;

$user->processParty($name,$color,$slogan,$image);
echo json_encode("saved successfully");
?>