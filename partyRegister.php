<?php 
require("party.php");

$json = file_get_contents('php://input');
$body = json_decode($json, true);
// echo json_encode($json);exit;
// error_reporting(0);

$name = $_REQUEST['partyName'];
$color = $_REQUEST['partyColor'];
$slogan = $_REQUEST['partySlogan'];
$image = $_REQUEST['partyImage'];


// $name = $body['partyName'];
// $color = $body['partyColor']; 
// $slogan = $body['partySlogan'];
// $image = $body['partyImage'];


// $filename = $_FILES['partyImage']["name"];
// $temp_name = $_FILES['partyImage']["tmp_name"];
// $upload_errors =$_FILES['partyImage']['error'];
// $folder = "./images" . $filename;


// if (move_uploaded_file($temp_name, $folder)) {
    
    $user = new Party;
    $user->processParty($name,$color,$slogan,$image);
    echo json_encode("saved successfully");

// } else {
//     echo json_encode("failed to upload image");
// }
    

?>