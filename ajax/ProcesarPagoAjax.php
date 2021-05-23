<?php

require_once "../controladores/Rutas.php";

require_once "../controladores/Pagos.controlador.php";
require_once "../modelos/Ordenes.modelo.php";
require_once "../vendor/autoload.php";

class ProcesarPagoAjax{

  /*=============================================
  PROCESAR PAGO
  =============================================*/

  public $precio;
  public $descripcion;
  public $id_orden;

  public function ajaxProcesarPago(){

    $datos = array('precio' => $this->precio,
				           'descripcion' => $this->descripcion,
				           'id_orden' => $this->id_orden);

    $respuesta = PagosControlador::ctrProcesarPago($datos);

    echo json_encode($respuesta);

  }

}

/*=============================================
PROCESAR PAGO
=============================================*/	
if(isset($_POST["id_orden"])){

	$procesarPago = new ProcesarPagoAjax();
	$procesarPago -> precio = $_POST["precio"];
	$procesarPago -> descripcion = $_POST["descripcion"];
	$procesarPago -> id_orden = $_POST["id_orden"];
	$procesarPago -> ajaxProcesarPago();
	
}

if (isset($_GET['reference'])) {

  $procesarRespuesta = new PagosControlador();
  $procesarRespuesta -> ctrRespuestaPago($_GET['reference']);

}










