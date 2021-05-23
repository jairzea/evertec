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
	
	/*=======================================
	=            Editar Ordenes            =
	========================================*/
	static public function ctrEditarOrdene($datos)
	{
		
		if (isset($datos["nombreOrden"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombreOrden"]))
            {

                $tabla = "orders";

                $respuesta = OrdenesModelo::mdlEditarOrden($tabla, $datos);

                if ($respuesta == "ok") {

                	$resultado = array('status' => 200, 
                					   'detalle' => 'El Orden ha sido actualizado correctamente');

                }else{

                	$resultado = array('status' => 400, 
                					   'detalle' => $respuesta[2]);

                }
            }else{

            	$resultado = array('status' => 400, 
                				   'detalle' => 'El nombre del Orden no puede ir vacío o llevar caracteres especiales!');

            }

            return $resultado;
        }

	}

	/*=============================================
	ELIMINAR PODUCTO
	=============================================*/
	static public function ctrEliminarOrden($id){

		if(isset($id) && !empty($id)){

			$tabla ="orders";
			$datos = $id;

			$respuesta = OrdenesModelo::mdlEliminarOrden($tabla, $datos);

			if ($respuesta == "ok") {

            	$resultado = array('status' => 200, 
            					   'detalle' => 'El Orden ha sido eliminado correctamente');

            }else{

            	$resultado = array('status' => 400, 
            					   'detalle' => $respuesta[2]);

            }

            return $resultado;

		}

	}
	
}