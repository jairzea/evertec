<?php

require_once "../controladores/Productos.controlador.php";
require_once "../modelos/Productos.modelo.php";

class AjaxProductos{

  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public function ajaxMostrarProductos(){

    $item = null;
    $valor = null;

    $respuesta = ProductosControlador::ctrMostrarProductos($item, $valor);

    echo json_encode($respuesta);

  }

}


/*=============================================
MOSTRAR PRODUCTOS
=============================================*/	

$traerProductos = new AjaxProductos();
$traerProductos -> ajaxMostrarProductos();









