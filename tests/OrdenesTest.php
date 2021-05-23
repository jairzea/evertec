<?php 

use PHPUnit\Framework\TestCase;
require_once 'controladores/Ordenes.controlador.php';
require_once 'modelos/Ordenes.modelo.php';

/**
 * Pruebas
 */
class OrdenesTest extends TestCase
{
	/** @test **/
	public function probarMostarTodosLosOrdenes()
	{
		$item = null;
		$valor = null;

		$resultado = OrdenesControlador::ctrMostrarOrdenes($item, $valor);

		$this->assertArrayHaskey('referencia_orden', $resultado[0]);
		$this->assertArrayHaskey('nombre', $resultado[0]);
		$this->assertArrayHaskey('requestId', $resultado[0]);

	}

	/** @test **/
	public function probarMostarOrdenesUsuario()
	{
		$item = 'email';
		$valor = 'jairzeapaez@gmail.com';

		$resultado = OrdenesControlador::ctrMostrarOrdenes($item, $valor);

		$this->assertArrayHaskey('referencia_orden', $resultado[0]);
		$this->assertArrayHaskey('nombre', $resultado[0]);
		$this->assertArrayHaskey('requestId', $resultado[0]);

	}

	/** @test **/
	public function probarCrearUnaOrden()
	{	


		$datos = array('customer_name' => 'Zapatos elegantes 3',
					   'customer_email' => 'jairzeapaez@gmail.com',
					   'customer_mobile' => '3217098185',
					   'id_product' => '3',
					   'status' => 'CREATED');

		$id_cliente = str_replace("$", "a", crypt($datos["customer_name"].$datos["customer_email"].$datos["customer_mobile"], '$2a$07$asxx54ahjppf45sd87a5a4dDDprotechdev$'));
        $llave_secreta = str_replace("$","o", crypt($datos["customer_email"].$datos["customer_name"].$datos["customer_mobile"], '$2a$07$asxx54ahjppf45sd87a5a4dDDprotechdev$'));
        
        $token = "Basic ".base64_encode($id_cliente.":".$llave_secreta);

        $datos['id_cliente'] = $id_cliente;
        $datos['llave_secreta'] = $llave_secreta;
        $datos['token'] = $token;
		
		$resultado = OrdenesControlador::ctrCrearOrden($datos);

		$this->assertEquals(200, $resultado['status']);

	}

	// /** @test **/
	// public function probarEditarUnProducto()
	// {
	// 	$datos = array('nombreProducto' => 'Producto Editado',
	// 				   'descripcionProducto' => 'Producto de prueba',
	// 				   'precioProducto' => '100000',
	// 				   'imgProducto' => 'https://i2.wp.com/www.zapatos.shopping/wp-content/uploads/2015/01/zapatos-hombre.jpg',
	// 					'id' => 12);
		
	// 	$resultado = OrdenesControlador::ctrEditarOrdenes($datos);

	// 	$this->assertEquals(200, $resultado['status']);

	// }

	// /** @test **/
	// public function probarEliminarUnProducto()
	// {
	// 	$id = '19'; /*Asigne un ID existente para realizar la prueba*/
		
	// 	$resultado = OrdenesControlador::ctrEliminarProducto($id);

	// 	$this->assertEquals(200, $resultado['status']);

	// }
}