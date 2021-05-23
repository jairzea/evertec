<?php

require_once "../controladores/ResumenOrdenes.controlador.php";
require_once "../modelos/ResumenOrdenes.modelo.php";

require_once "../modelos/Ordenes.modelo.php";

class MostrarResumenOrdenesAjax{

  /*=============================================
  MOSTRAR RESUMEN DE ORDENES 
  =============================================*/ 

  public function ajaxMostrarResumenOrdenes()
  {

  	$token = apache_request_headers();

    $item = 'token';
    $valor = $token['authorization'];

    $ordenes = ResumenOrdenesControlador::ctrMostrarResumenOrdenes($item, $valor);

    if (count($ordenes) == 0) {

        $datosJson = '{"data":[]}';

        echo $datosJson;

        return;
    }

    echo json_encode($ordenes);

  }

}

/*=============================================
MOSTRAR RESUMEN DE ORDENES
=============================================*/	

$resumenOrden = new MostrarResumenOrdenesAjax();
$resumenOrden -> ajaxMostrarResumenOrdenes();












