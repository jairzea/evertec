<?php

require_once "../controladores/Productos.controlador.php";
require_once "../modelos/Productos.modelo.php";

class EditarProductosAjax{

  /*=============================================
  EDITAR PRODUCTOS
  =============================================*/

  public $nombreProducto;
  public $descripcionProducto;
  public $precioProducto;
  public $imgProducto;
  public $id;

  public function ajaxEditarProductos(){

  	if (empty($this->nombreProducto)) {
  		
  		echo json_encode(array('status' => 400, 
                			   'detalle' => 'El nombre del producto no puede ir vacío'));

  		exit();
  	}

  	if (empty($this->descripcionProducto)) {
  		
  		echo json_encode(array('status' => 400, 
                			   'detalle' => 'la Descripcion del producto no puede ir vacía'));

  		exit();
  	}

  	if (empty($this->precioProducto)) {
  		
  		echo json_encode(array('status' => 400, 
                			   'detalle' => 'El precio del producto no puede ir vacío'));

  		exit();
  	}

  	if (empty($this->imgProducto)) {
  		
  		echo json_encode(array('status' => 400, 
                			   'detalle' => 'Debe relacionar un link para la imagen del producto'));

  		exit();
  	}

    $datos = array('nombreProducto' => $this->nombreProducto,
				   'descripcionProducto' => $this->descripcionProducto,
				   'precioProducto' => $this->precioProducto,
				   'imgProducto' => $this->imgProducto,
				   'id' => $this->id);

    $respuesta = ProductosControlador::ctrEditarProductos($datos);

    echo json_encode($respuesta);

  }

}

/*=============================================
EDITAR PRODUCTOS
=============================================*/	
if(isset($_POST["nombreProducto"])){

	$editarProductos = new EditarProductosAjax();
	$editarProductos -> nombreProducto = $_POST["nombreProducto"];
	$editarProductos -> descripcionProducto = $_POST["descripcionProducto"];
	$editarProductos -> precioProducto = $_POST["precioProducto"];
	$editarProductos -> imgProducto = $_POST["imgProducto"];
	$editarProductos -> id = $_POST["id"];
	$editarProductos -> ajaxEditarProductos();
	
}










