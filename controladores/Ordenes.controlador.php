<?php

class OrdenesControlador
{

	/*=========================================
	=            Mostrar Ordenes            =
	=========================================*/
	static public function ctrMostrarOrdenes($item, $valor)
	{
		$tabla = "vista_orders_products";

		$respuesta = OrdenesModelo::mdlMostrarOrdenes($tabla, $item, $valor);

		return $respuesta;
	}

	/*=======================================
	=            Crear Ordenes            =
	========================================*/
	static public function ctrCrearOrden($datos)
	{
		
		if (isset($datos["customer_name"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["customer_name"]))
            {

                $tabla = "orders";

                $respuesta = OrdenesModelo::mdlCrearOrden($tabla, $datos);

                if ($respuesta == "ok") {

                	$resultado = array('status' => 200, 
                					   'detalle' => 'La Orden ha sido guardado correctamente',
                                       'credenciales' => array('id_cliente' => $datos['id_cliente'],
                                                                'llave_secreta' => $datos['llave_secreta'])
                                    );

                }else{

                	$resultado = array('status' => 400, 
                					   'detalle' => $respuesta[2]);

                }
            }else{

            	$resultado = array('status' => 400, 
                				   'detalle' => 'El nombre de la Orden no puede ir vacío o llevar caracteres especiales!');

            }

            return $resultado;
        }

	}
	
}