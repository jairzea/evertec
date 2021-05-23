<?php

require_once "../controladores/Productos.controlador.php";
require_once "../modelos/Productos.modelo.php";

class CrearProductosAjax{

  /*=============================================
  CREAR PRODUCTOS
  =============================================*/

  public $nombreProducto;
  public $descripcionProducto;
  public $precioProducto;
  public $imgProducto;

  public function ajaxCrearProductos(){

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
				   'imgProducto' => $this->imgProducto);

    $respuesta = ProductosControlador::ctrCrearProductos($datos);

    echo json_encode($respuesta);

  }

}

/*=============================================
CREAR PRODUCTOS
=============================================*/	
if(isset($_POST["nombreProducto"])){

	$crearProductos = new CrearProductosAjax();
	$crearProductos -> nombreProducto = $_POST["nombreProducto"];
	$crearProductos -> descripcionProducto = $_POST["descripcionProducto"];
	$crearProductos -> precioProducto = $_POST["precioProducto"];
	$crearProductos -> imgProducto = $_POST["imgProducto"];
	$crearProductos -> ajaxCrearProductos();
	
}










