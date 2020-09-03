<?php
//required headers

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require './vendor/autoload.php';

use App\Caraca;
use App\Connection;


//date_default_timezone_set("Asia/Kolkata");

//get posted data
$dataz = file_get_contents("php://input");
if(isset($dataz) && !empty($dataz)){
$data = json_decode($dataz);
//var_dump($_POST);
//var_dump($data);
}
//var_dump($data->nom);

$pdo = Connection::getPDO();
$caraca = new Caraca($pdo);


if(!empty($data)){
    //var_dump($participant);
    $pdo->beginTransaction();
    $id = $caraca->insertGroup($data->teamName);
    $pdo->commit();
}
if($id) {
    echo json_encode(
        array("message"=>"Participant was created.",
            "teamId" => $id)
    );
} else { // if unable to create team, notify user
    echo json_encode(
        array("message"=>"Unable to create team.")
    );
}
?>