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
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombreProducto"]))
            {

                $tabla = "products";

                $respuesta = ProductosModelo::mdlCrearProductos($tabla, $datos);

                if ($respuesta == "ok") {

                	$resultado = array('status' => 200, 
                					   'detalle' => 'El Producto ha sido guardado correctamente');

                }else{

                	$resultado = array('status' => 400, 
                					   'detalle' => $respuesta[2]);

                }
            }else{

            	$resultado = array('status' => 400, 
                				   'detalle' => 'El nombre del producto no puede ir vacío o llevar caracteres especiales!');

            }

            return $resultado;
        }

	}
	
	/*=======================================
	=            Editar Productos            =
	========================================*/
	static public function ctrEditarProductos($datos)
	{
		
		if (isset($datos["nombreProducto"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombreProducto"]))
            {

                $tabla = "products";

                $respuesta = ProductosModelo::mdlEditarProducto($tabla, $datos);

                if ($respuesta == "ok") {

                	$resultado = array('status' => 200, 
                					   'detalle' => 'El Producto ha sido actualizado correctamente');

                }else{

                	$resultado = array('status' => 400, 
                					   'detalle' => $respuesta[2]);

                }
            }else{

            	$resultado = array('status' => 400, 
                				   'detalle' => 'El nombre del producto no puede ir vacío o llevar caracteres especiales!');

            }

            return $resultado;
        }

	}

	/*=============================================
	ELIMINAR PODUCTO
	=============================================*/
	static public function ctrEliminarProducto($id){

		if(isset($id) && !empty($id)){

			$tabla ="products";
			$datos = $id;

			$respuesta = ProductosModelo::mdlEliminarProducto($tabla, $datos);

			if ($respuesta == "ok") {

            	$resultado = array('status' => 200, 
            					   'detalle' => 'El Producto ha sido eliminado correctamente');

            }else{

            	$resultado = array('status' => 400, 
            					   'detalle' => $respuesta[2]);

            }

            return $resultado;

		}

	}
	
}