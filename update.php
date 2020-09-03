<?php

use App\Caraca;
use App\Connection;


require './vendor/autoload.php';

//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Mehods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$dataz = file_get_contents("php://input");
if(isset($dataz) && !empty($dataz)){
$data = json_decode($dataz);
//var_dump($_POST);
//var_dump($data);
}

$pdo= Connection::getPDO();
$caraca = new Caraca($pdo);


if(!empty($data)){
    $id = $data->id;
    $qst = $data->questions;
    $rep = $data->reponses;
    $temps = $data->temps;
    $etat = $data->etat;

    //var_dump($participant);
    $pdo->beginTransaction();
    $caraca->updateGroup($id, $qst, $rep, $temps, $etat);
    $pdo->commit();
}
?>
