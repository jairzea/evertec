<?php

class Ruta{

	public function ctrRuta(){


		if(isset($_SERVER['HTTPS'])){
           
           $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
       	
       	}else{
        
           $protocol = 'http';

       	}
       	
       	return $protocol . "://" . $_SERVER['HTTP_HOST'] . '/evertec/';
			
	}



	public function ctrRutaArchivoConfig(){

		return dirname(__DIR__);
	
	}

}