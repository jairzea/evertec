<?php

class Conexion{

	static public function conectar(){

		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'evertec';

		$link = new PDO("mysql:host=$servername;dbname=$dbname",
			            "$username",
			            "$password");

		$link->exec("set names utf8");

		return $link;

	}

}