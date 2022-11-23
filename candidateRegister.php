<?php

require ("candidate.php");

$json = file_get_contents("php://input");
$body = json_decode($json,true);

$name = $body['candidateName'];
$dob = $body['candidateDob'];
$party = $body['candidateParty'];
$gender = $body['candidateGender'];
$position = $body['candidatePosition'];

// $name = $_REQUEST['candidateName'];
// $dob = $_REQUEST['candidateDob'];
// $party = $_REQUEST['candidateParty'];
// $gender = $_REQUEST['candidateGender'];
// $position = $_REQUEST['candidatePosition'];

$user = new Candidate;

$user->processCandidate($name,$dob,$party,$gender,$position); 
echo json_encode("saved successfully");