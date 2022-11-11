<?php
require("db.php");
require("config.php");

class User extends Database
{

    public $name;
    public $email;
    public $address;
    public $occupation;
    public $gender;
    public $status;
    public $table = "user";
    public $result = "";


    public function userInfo($condition = "", $field = "*", $column = "")
    {
        return $this->lookUp($this->table, $field, $condition, $column);
    }

    
    public function singleUserInfo($userId) {
        $this->result = $this->userInfo("id = '$userId'")[0];
        $this->name = $this->result['name'];
        $this->address = $this->result['address'];
        $this->occupation = $this->result['occupation'];
        $this->gender = $this->result['gender'];
        $this->status = $this->result['status'];

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
        if (empty($this->name) || empty($this->email) || empty($this->address)|| empty($this->occupation) || empty($this->gender)) {
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

    public function validateNewUser()
    {
        if (empty($this->name) || empty($this->address)|| empty($this->occupation) || empty($this->gender)) {
            echo json_encode ("None of the fields must be empty!");
            exit;
        }
        
        if (is_numeric($this->name)) {
            echo json_encode("Name must be in text only!");
            exit;
        }
        
        
    }
    public function processUser($name, $address, $email, $occupation, $gender)
    {
        

        $this->name = $this->escape($name);
        $this->address = $this->escape($address);
        $this->email = $this->escape($email);
        $this->occupation = $this->escape($occupation);
        $this->gender = $this->escape($gender);
        
        $this->validateUser();
        $this->saveUser();

    }

    public function processNewUser($condition = "", $name, $address, $occupation, $gender)
    {
        $this->name = $this->escape($name);
        $this->address = $this->escape($address);
        $this->occupation = $this->escape($occupation);
        $this->gender = $this->escape($gender);
        
        $this->validateNewUser();
        $this->updateUser($condition);

    }

    
    public function saveUser()
    {

        return $this->save(
        $this->table, 
        "name = '$this->name',
        address = '$this->address',
        email = '$this->email', 
        occupation = '$this->occupation',
        gender = '$this->gender'");
    }

    public function updateUser($userId) {
        return $this->saveChanges($this->table, 
        "name = '$this->name',
        address = '$this->address',
        occupation = '$this->occupation',
        gender = '$this->gender'", "id = $userId");
    }

    public function eraseUser($userId)
    {
        return $this->erase($this->table, "id = '$userId'"
        );
    }
}