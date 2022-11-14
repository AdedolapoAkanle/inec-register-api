<?php 
require("party.php");

$json = file_get_contents("php://input");
$body = json_decode($json, true);
echo json_encode($body);

// $image = $body['image'];


if (isset($body['register']) && isset($_FILES['image'])) {
    echo "<pre>";
    print_r($FILES['image']);
    echo "</pre>";

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp = $_FILES['image']['tmp_name'];
    $img_error = $_FILES['image']['error'];
    $img_type = $_FILES['image']['type'];

} else {
    // echo json_encode("null");
}

?>