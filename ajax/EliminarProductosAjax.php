<?php

require_once "../controladores/Productos.controlador.php";
require_once "../modelos/Productos.modelo.php";

class EliminarProductosAjax{

  /*=============================================
  CREAR PRODUCTOS
  =============================================*/

  public $id;

  public function ajaxEliminarProductos(){

    $respuesta = ProductosControlador::ctrEliminarProducto($this->id);

    echo json_encode($respuesta);

  }

}

/*=============================================
CREAR PRODUCTOS
=============================================*/	
if(isset($_GET["id"])){

	$crearProductos = new EliminarProductosAjax();
	$crearProductos -> id = $_GET["id"];
	$crearProductos -> ajaxEliminarProductos();
	
}










