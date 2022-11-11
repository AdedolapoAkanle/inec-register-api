<?php 
    require("user.php");
        
    $json = file_get_contents('php://input');
 
    $body = json_decode($json, true); 
  
    
   //  $col =  $_REQUEST['searchType'];
   //  $val =  $_REQUEST['search'];
    
    $col =  $body['searchType'];
    $val =  $body['search'];
    $value = "$col $val";
   
     if(!empty($col) && !empty($val)){
        $condition = "$col like '%$val%'";
     } else{
        $condition = "";
     }
    
     $user = new User;
     $rlt = $user->userInfo($condition);
     echo json_encode($rlt);
     exit;


     
      
    