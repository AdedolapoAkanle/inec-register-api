<?php
require ("db.php");
require ("config.php");

class Login extends Database
{
    public $email;
    public $password;
    public $table = "register";
    public $result;

    public function userInfo($condition = "", $field = "*", $column = "")
    {
        $this->lookUp($this->table, $field, $condition, $column);
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
    public function validateUserSignIn()
    {
        $pwd = sha1($this->password);

        if (empty($this->email)  || empty($this->password)) {
            echo json_encode ("None of the fields must be empty!");
            exit;
        }

        if (($this->isExists("email = '$this->email'")) && ($this->isExists("password='$pwd'"))) {
            $this->lookUp($this->table, "*", "email='$this->email'");
            return true;
            
        } else {
            echo json_encode("Incorrect Email Or Password!");
            exit;
        }
    }

    public function processUserSignIn($email, $password)
    {
        $loggedIn = false;
        $this->email = $this->escape($email);
        $this->password = $password;

        $this->validateUserSignIn();
        $loggedIn = true;

        return $loggedIn;

    }
}