<?php

require_once "../controladores/Ordenes.controlador.php";
require_once "../modelos/Ordenes.modelo.php";

class MostrarOrdenesAjax{

  /*=============================================
  MOSTRAR PRODUCTOS
  =============================================*/ 

  public $item;
  public $valor;

  public function ajaxMostrarOrdenes(){

    $item = $this->item;
    $valor = $this->valor;

    $ordenes = OrdenesControlador::ctrMostrarOrdenes($item, $valor);

    if (count($ordenes) == 0) {

        $datosJson = '{"data":[]}';

        echo $datosJson;

        return;
    }

    foreach ($ordenes as $key => $value) {

    	$data['id_orden'] = $value['id_orden'];
		$data['nombre'] = $value['nombre'];
		$data['telefono'] = $value['telefono'];
		$data['email'] = $value['email'];
		$data['referencia_orden'] = $value['referencia_orden'];
		$data['created_at'] = $value['created_at'];
		$data['nombre_producto'] = $value['nombre_producto'];
		$data['precio_producto'] = $value['precio_producto'];
		$data['estado'] = $value['estado'];
		$data['imagen_producto'] = $value['imagen_producto'];
		$data['name'] = $value['nombre_producto'];

		if ($value['estado'] == 'APPROVED') {
			
			$data['url_pago'] = '<div><a style="color: green" href="'.$value['url_pago'].'" target="_blank">Url de pago</a></div>';

			$data['boton'] = '<div class="btn-group"><button class="btn btn-success btn-sm"><i class="fa fa-check"></i></div>';

		}else{

			$data['url_pago'] = '<div><a style="color: red" href="'.$value['url_pago'].'" target="_blank">Url de pago</a></div>';

			$data['boton'] = '<div class="btn-group"><button class="btn btn-warning btn-sm btnReintentarPago" id_cliente='.$value['id_cliente'].' llave_secreta='.$value['llave_secreta'].'><i class="fa fa-refresh"></i></div>';

		}

		$val[] = $data;
    }

    echo json_encode($val);

  }

}

/*=============================================
MOSTRAR PRODUCTOS
=============================================*/	
if (isset($_POST["item"]) && !empty($_POST["item"])) {
	
	$traerProductos = new MostrarOrdenesAjax();
	$traerProductos -> item = $_POST["item"];
	$traerProductos -> valor = $_POST["valor"];
	$traerProductos -> ajaxMostrarOrdenes();

}else{

	$traerProductos = new MostrarOrdenesAjax();
	$traerProductos -> item = null;
	$traerProductos -> valor = null;
	$traerProductos -> ajaxMostrarOrdenes();

}










