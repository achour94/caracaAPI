<?php
namespace App;

use Caraca;
use PDO;

class Connection {

    public static $pdo;

    public static function getPDO() : PDO
    {
        if (!self::$pdo){
            self::$pdo = new PDO('mysql:dbname=gp-challenges_com;host=myqphx16', 'gp-chall_com_dbo','bicNS53t',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            //self::$pdo = new PDO('mysql:dbname=caraca_bdd;host=localhost', 'root','',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }


    public static function getColor($type){

		switch ($type) {
			case 1:
				return '#FFD200';
				break;
			case 2:
				return '#A885D8';
				break;
			case 3:
				return '#F16E00';
				break;
			case 4:
				return '#4BB4E6';
				break;
			case 5 :
				return '#FFFFFF';
				break;
			default:
				return '';
		}
	}
}
