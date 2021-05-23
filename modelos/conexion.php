<?php


// require_once $_SERVER['DOCUMENT_ROOT']."/evertec/vendor/autoload.php";
require_once dirname(__DIR__)."/vendor/autoload.php";


use Dotenv\Dotenv;

class Conexion{

	static public function conectar(){


		$dotenv = Dotenv::createImmutable(dirname(__DIR__));
		$dotenv->load();

		$servername = $_ENV['HOST_NAME'];
		$username   = $_ENV['DB_USER'];
		$password   = $_ENV['DB_PASSWORD'];
		$dbname     = $_ENV['DB_NAME'];

		$link = new PDO("mysql:host=$servername;dbname=$dbname",
			            "$username",
			            "$password");

		$link->exec("set names utf8");

		return $link;

	}

}