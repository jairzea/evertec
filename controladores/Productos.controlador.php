<?php

class ProductosControlador
{

	/*=========================================
	=            Mostrar Productos            =
	=========================================*/
	static public function ctrMostrarProductos($item, $valor)
	{
		$tabla = "products";

		$respuesta = ProductosModelo::mdlMostrarProductos($tabla, $item, $valor);

		return $respuesta;
	}

	/*=======================================
	=            Crear Productos            =
	========================================*/
	static public function ctrCrearProductos($datos)
	{
		
		if (isset($datos["nombreProducto"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombreProducto"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["descripcionProducto"]))
            {

                $tabla = "products";

                $respuesta = ProductosModelo::mdlCrearProductos($tabla, $datos);

                if ($respuesta == "ok") {

                	$resultado = array('status' => 200, 
                					   'mensaje' => 'El Producto ha sido guardado correctamente');

                }else{

                	$resultado = array('status' => 400, 
                					   'mensaje' => $respuesta[2]);

                }
            }else{

            	$resultado = array('status' => 400, 
                				   'mensaje' => 'El producto o su descripcion no pueden ir vacío o llevar caracteres especiales!');

            }

            return $resultado;
        }

	}
	
	
}