<?php
require("db.php");
require("config.php");

class Register extends Database
{

    public $name;
    public $email;
    public $password;
    public $status;
    public $table = "register";
    public $result = "";


    public function userInfo($condition = "", $field = "*", $column = "")
    {
        return $this->lookUp($this->table, $field, $condition, $column);
    }

    
    public function singleUserInfo($userId) {
        $this->result = $this->userInfo("id = '$userId'")[0];
        $this->name = $this->result['name'];
        $this->email = $this->result['email'];
        $this->password = $this->result['password'];
       

     }

   

   public function userResult($userId) {
     $this->singleUserInfo($userId);
     return $this->result;

   }
    
     
    public function countUserRows($conditions)
    {
        return $this->countRows($this->table, "*", $conditions);
    }

    public function isExists($conditions)
    {
        $rlt = $this->countUserRows($conditions);
        if ($rlt > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function validateUser()
    {
        $pwd = sha1($this->password);

        if (empty($this->name) || empty($this->email) || empty($pwd)) {
            echo json_encode ("None of the fields must be empty!");
            exit;
        }
        
        if (is_numeric($this->name)) {
            echo json_encode("Name must be in text only!");
            exit;
        }
        

        if (($this->isExists("email = '$this->email'"))) {
            echo json_encode("This entry already exists!");
            exit;
        }

        
    }

    
    public function processUser($name, $email, $password)
    {
        

        $this->name = $this->escape($name);
        $this->email = $this->escape($email);
        $this->password = $this->escape($password);

        
        $this->validateUser();
        $this->saveUser();

    }

    
    
    public function saveUser()
    {
        $pwd = sha1($this->password);
        return $this->save(
        $this->table, 
        "name = '$this->name',
        email = '$this->email', 
        password = '$pwd'");
    }

    
    public function eraseUser($userId)
    {
        return $this->erase($this->table, "id = '$userId'"
        );
    }
}