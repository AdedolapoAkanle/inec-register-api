<?php
require("user.php");
        
$json = file_get_contents('php://input');

$body = json_decode($json, true); 

$id = $body['id'];
// $id = $_REQUEST['id'];

$user = new User;

$rlt = $user->userResult($id);
echo json_encode($rlt);