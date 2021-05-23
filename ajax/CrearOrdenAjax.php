<?php

require_once "../controladores/Ordenes.controlador.php";
require_once "../modelos/Ordenes.modelo.php";

class CrearProductosAjax
{

  /*=============================================
  CREAR PRODUCTOS
  =============================================*/

  public $nombre;
  public $email;
  public $telefono;
  public $id_producto;

  public function ajaxCrearOrdenes()
  {

    $datos = array('customer_name' => $this->nombre,
				   'customer_email' => $this->email,
				   'customer_mobile' => $this->telefono,
				   'id_product' => $this->id_producto,
           'status' => 'CREATED');

    $id_cliente = str_replace("$", "a", crypt($datos["customer_name"].$datos["customer_email"].$datos["customer_mobile"], '$2a$07$asxx54ahjppf45sd87a5a4dDDprotechdev$'));
        $llave_secreta = str_replace("$","o", crypt($datos["customer_email"].$datos["customer_name"].$datos["customer_mobile"], '$2a$07$asxx54ahjppf45sd87a5a4dDDprotechdev$'));
        
        $token = "Basic ".base64_encode($id_cliente.":".$llave_secreta);

        $datos['id_cliente'] = $id_cliente;
        $datos['llave_secreta'] = $llave_secreta;
        $datos['token'] = $token;

    $respuesta = OrdenesControlador::ctrCrearOrden($datos);

    echo json_encode($respuesta);

  }

}

/*=============================================
CREAR PRODUCTOS
=============================================*/	
if(isset($_POST["id_producto"])){

	$crearProductos = new CrearProductosAjax();
	$crearProductos -> nombre = $_POST["nombre"];
	$crearProductos -> email = $_POST["email"];
	$crearProductos -> telefono = $_POST["telefono"];
	$crearProductos -> id_producto = $_POST["id_producto"];
	$crearProductos -> ajaxCrearOrdenes();
	
}










