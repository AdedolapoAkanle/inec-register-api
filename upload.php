<?php 
// require("party.php");

// $json = file_get_contents("php://input");
// $body = json_decode($json, true);
// echo json_encode($body);

// // $image = $body['image'];


// if (isset($_FILES['register'])) {
//     echo "<pre>";
//     print_r($_FILES['partyImage']);
//     echo "</pre>";

//     $filename = $_FILES['partyImage']['name'];
//     $filesize = $_FILES['partyImage']['size'];
//     $tmp = $_FILES['partyImage']['tmp_name'];
//     $folder = "./image/" . $filename;
//     // $img_error = $_FILES['partyImage']['error'];
//     // $img_type = $_FILES['partyImage']['type'];

// } else {
//     echo json_encode("null");
// }



?>

<?php
require("config.php");

$json = file_get_contents("php://input");
$body = json_decode($json, true);
error_reporting(0);
 
$msg = "";
 
// If upload button is clicked ...
if (isset($_POST['upload'])) {
 
    $filename = $_FILES["partyImage"]["name"];
    $tempname = $_FILES["partyImage"]["tmp_name"];
    $folder = "images" . $filename;
 
    $db = mysqli_connect("localhost", "root", "", "inec_register");
 
    $sql = "INSERT INTO image (partyImage) VALUES ('$filename')";
 
    mysqli_query($db, $sql);
 
    if (move_uploaded_file($tempname, $folder)) {
        echo json_encode("successful");
    } else {
        echo json_encode("failed");
    }
}
?>