<?php
require("db.php");
require("config.php");

class Party extends Database
{

    public $partyName;
    public $partyColor;
    public $partySlogan;
    public $partyImage;
    public $status;
    public $table = "party_register";
    public $result = "";


    public function partyInfo($condition = "", $field = "*", $column = "")
    {
        return $this->lookUp($this->table, $field, $condition, $column);
    }

    
    public function singlePartyInfo($userId) {
        $this->result = $this->partyInfo("id = '$userId'")[0];
        $this->partyName = $this->result['name'];
        $this->partyColor = $this->result['color'];
        $this->partySlogan = $this->result['slogan'];
        $this->partyImage = $this->result['image'];
        $this->status = $this->result['status'];

     }

   

   public function partyResult($userId) {
     $this->singlePartyInfo($userId);
     return $this->result;

   }
    
     
    public function countPartyRows($conditions)
    {
        return $this->countRows($this->table, "*", $conditions);
    }

    public function isExists($conditions)
    {
        $rlt = $this->countPartyRows($conditions);
        if ($rlt > 0) {
            return true;
        } else {
            return false;
        }
    }
    


    public function validateParty()
    {
        if (empty($this->partyName) || empty($this->partyColor) || empty($this->partySlogan)|| empty($this->partyImage) ) {
            echo json_encode ("None of the fields must be empty!");
            exit;
        }
        
        if (is_numeric($this->partyName)) {
            echo json_encode("Name must be in text only!");
            exit;
        }
        

        // if (($this->isExists("email = '$this->email'"))) {
        //     echo json_encode("This entry already exists!");
        //     exit;
        // }

        
    }

    public function processParty($partyName, $partyColor, $partySlogan, $partyImage)
    {
    
        $this->partyName = $this->escape($partyName);
        $this->partyColor = $this->escape($partyColor);
        $this->partySlogan = $this->escape($partySlogan);
        $this->partyImage = $this->escape($partyImage);
        
        // $this->validateParty();
        $this->saveParty();

    }

    
    
    public function saveParty()
    {

        return $this->save($this->table, 
        "name = '$this->partyName',
        color = '$this->partyColor',
        slogan = '$this->partySlogan', 
        image = '$this->partyImage'");
    }

    public function saveImage() {
        return $this->save($this->table, "image = $this->partyImage");
    }

    public function updateParty($userId) {
        return $this->saveChanges($this->table, 
        "name = '$this->partyName',
        color = '$this->partyColor',
        slogan = '$this->partySlogan', 
        image = '$this->partyImage'", "id = $userId");
    }

    public function eraseParty($userId)
    {
        return $this->erase($this->table, "id = '$userId'"
        );
    }
}