<?php

class Ruta{

	/**
	 *
	 * Modifique esta ruta base del Frontend
	 * 
	 */
	public function ctrRuta(){

		// return "http://localhost/evertec/";

		if(isset($_SERVER['HTTPS'])){
           
           $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
       	
       	}else{
        
           $protocol = 'http';

       	}
       	
       	return $protocol . "://" . $_SERVER['HTTP_HOST'] . '/evertec/';
		
		// return $_SERVER['SERVER_NAME'];
	
	}

	/**
	 *
	 * Modifique esta ruta para hacer la conexión a la api
	 * 
	 */
	public function ctrRutaBacken(){

		return "http://apirest-tienda.evertec";
	
	}

	public function ctrRutaArchivoConfig(){

		return dirname(__DIR__);
	
	}

}