<?php
require("db.php");
require("config.php");

class Candidate extends Database
{

    public $name;
    public $dob;
    public $party;
    public $gender;
    public $position;
    public $status;
    public $table = "candidate_register";
    public $result = "";


    public function candidateInfo($condition = "", $field = "*", $column = "")
    {
        return $this->lookUp($this->table, $field, $condition, $column);
    }

    
    public function singleCandidateInfo($userId) {
        $this->result = $this->candidateInfo("id = '$userId'")[0];
        $this->name = $this->result['name'];
        $this->dob = $this->result['dob'];
        $this->party = $this->result['party'];
        $this->gender = $this->result['gender'];
        $this->position = $this->result['position'];
        $this->status = $this->result['status'];

     }

   

   public function candidateResult($userId) {
     $this->singleCandidateInfo($userId);
     return $this->result;

   }
    
     
    public function countCandidateRows($conditions)
    {
        return $this->countRows($this->table, "*", $conditions);
    }

    public function isExists($conditions)
    {
        $rlt = $this->countCandidateRows($conditions);
        if ($rlt > 0) {
            return true;
        } else {
            return false;
        }
    }
    


    public function validateCandidate()
    {
        if (empty($this->name) || empty($this->dob) || empty($this->party)|| empty($this->gender)|| empty($this->position) ) {
            echo json_encode ("None of the fields must be empty!");
            exit;
        }
        
        if ((is_numeric($this->name)) || is_numeric($this->party)) {
            echo json_encode("Name or party must be in text only!");
            exit;
        }
        

        
        
    }

    public function processCandidate($name, $dob, $party, $gender, $position)
    {
    
        $this->name = $this->escape($name);
        $this->dob = $this->escape($dob);
        $this->party = $this->escape($party);
        $this->gender = $this->escape($gender);
        $this->position = $this->escape($position);
        
        $this->validateCandidate();
        $this->saveCandidate();

    }

    
    
    public function  saveCandidate()
    {

        return $this->save($this->table, 
        "name = '$this->name',
        dob = '$this->dob',
        party = '$this->party', 
        gender = '$this->gender',
        position = '$this->position'");
    }

    

    public function updateCandidate($userId) {
        return $this->saveChanges($this->table, 
        "name = '$this->name',
        color = '$this->dob',
        slogan = '$this->party', 
        image = '$this->gender'", "id = $userId");
    }

    public function eraseCandidate($userId)
    {
        return $this->erase($this->table, "id = '$userId'"
        );
    }
}