<?php
  require("user.php"); 
    $json = file_get_contents('php://input');
   
    $body = json_decode($json, true); 

    $id = $body['id'];
    // $id = $_REQUEST['id'];
    
   if(!empty($id)){
        $user = new User; 
        if($user->isExists("id = '$id'")){
            $user->eraseUser($id);
            echo json_encode("deleted successfully");
            exit;
        }else{
            echo json_encode("entry already deleted");
            exit;
        }
   }else{
    echo json_encode("Missing ID");
    exit;
   }
   
?>