<?php

require './vendor/autoload.php';

use App\Caraca;
use App\Connection;


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$pdo = Connection::getPDO();
$list = (new Caraca($pdo))->getQuestions();

echo json_encode($list);

?>