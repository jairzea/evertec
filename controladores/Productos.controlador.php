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
		if (isset($datos) && is_array($datos)) {
			
			$respuesta = array('status' => 200);

		}else{

			$respuesta = array('status' => 400);
		}

		return $respuesta;
	}
	
	
}