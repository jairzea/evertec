<?php

use Dotenv\Dotenv;
use Dnetix\Redirection\PlacetoPay;

class PagosControlador
{

	/*=========================================
	=            Mostrar Ordenes            =
	=========================================*/
	static public function ctrProcesarPago($datos)
	{
		
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        $placetopay = new PlacetoPay([
            'login'   => $_ENV['LOGIN'],
            'tranKey' => $_ENV['TANKEY'],
            'url'     => $_ENV['URL_REDIRECT'],
            'rest'    => [
                'timeout' => 45,
                'connect_timeout' => 30,
            ]
        ]);

        return $placetopay;

        $reference = $id.'TEST_' . time();
	}
	
}