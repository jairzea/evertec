<?php

use Dotenv\Dotenv;

class Ruta{

	static public function ctrRuta(){

		$dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();


		if(isset($_SERVER['HTTPS'])){
           
           $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
       	
       	}else{
        
           $protocol = 'http';

       	}
       	
       	return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_ENV['PROJECT_FOLDER'];
			
	}



	static public function ctrRutaArchivoConfig(){

		return dirname(__DIR__);
	
	}

}