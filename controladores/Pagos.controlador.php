<?php

use Dotenv\Dotenv;
use Dnetix\Redirection\PlacetoPay;

class PagosControlador
{

	/*=====================================
	=           Procesar Pago             =
	======================================*/
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

        $reference = $datos["id_orden"].'TEST_' . time();

        $request = [
            'payment' => [
                'reference' => $reference,
                'description' => $datos["descripcion"],
                'amount' => [
                    'currency' => 'COP',
                    'total' => $datos["precio"],
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => $_ENV['URL_RETORNO'].'?reference=' . $reference,
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];

        $response = $placetopay->request($request);

        if ($response->isSuccessful()) {

            $tablaOrden = 'orders';
            
            $respPlace = array(
                'status' => 200,
                'requestId' => $response->requestId(),
                'reference' => $reference,
                'processUrl' => $response->processUrl(),
                'id' => $datos["id_orden"]
            );

            $actualizar_orden = OrdenesModelo::mdlActualizarOrden($tablaOrden, $respPlace);
            
            if($actualizar_orden == 'ok'){

                $respuesta = $respPlace;

            }else{

                $respuesta = 'No se pudo actualizar la orden';

            }

        }else {

            $respuesta = $response->status()->message();
        }


        return $respuesta;

	}

    /*=====================================
    =     Procesar Respuesta Pasarela     =
    ======================================*/
    static public function ctrRespuestaPago($reference)
    {
        if (isset($reference)) {
           
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

            $tablaOrden = 'orders';
            $item = 'reference';
            $valor = $reference;

            $orden = OrdenesModelo::mdlMostrarOrdenes($tablaOrden, $item, $valor);

            $response = $placetopay->query($orden[0]['requestId']);

            if ($response->isSuccessful()) {

                switch ($response->status()->status()) {

                    case 'APPROVED':
                        
                        $datos = ['status'     => $response->payment[0]->status()->status(),
                                  'message'    => $response->payment[0]->status()->message(),
                                  'date_trans' => $response->payment[0]->status()->date(),
                                  'method'     => $response->payment[0]->paymentMethodName(),
                                  'ref_int'    => $response->payment[0]->internalReference(),
                                  'bank'       => $response->payment[0]->issuerName(),
                                  'reference'  => $reference
                                ];

                        break;
                    
                    case 'PENDING':
                        
                        $datos = ['status'     => $response->status()->status(),
                                  'message'    => $response->status()->message(),
                                  'date_trans' => $response->status()->date(),
                                  'method'     => '',
                                  'ref_int'    => '',
                                  'bank'       => '',
                                  'reference'  => $reference
                                ];

                        break;

                    default:
                        
                        $datos = ['status'     => $response->status()->status(),
                                  'message'    => $response->status()->message(),
                                  'date_trans' => $response->status()->date(),
                                  'method'     => '',
                                  'ref_int'    => '',
                                  'bank'       => '',
                                  'reference'  => $reference
                                ];
                            
                        break;
                }


                $actualizar_orden = OrdenesModelo::mdlActualizarOrdenRespuesta($tablaOrden, $datos);
                                
                if($actualizar_orden == 'ok'){
                    
                    header ("Location: ".Ruta::ctrRuta().'respuesta-pago');
                    exit();

                }

            } else {

                print_r($response->status()->message() . "\n");

            }
        }

    }
	
}