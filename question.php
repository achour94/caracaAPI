<?php
//required headers
require './vendor/autoload.php';

use App\Caraca;
use App\Connection;


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-ALlow-Mehods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");


$pdo = Connection::getPDO();
$caraca = new Caraca($pdo);
$id = isset($_GET['id']) ? $_GET['id'] : die();
//$question = $caraca->question($id);
$reponse = $caraca->reponse($id);
/*
$questionArr = array(
    "question" => $question,
    "reponse" => $reponse,
);
*/
print_r(json_encode($reponse));
