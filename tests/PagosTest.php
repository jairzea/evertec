<?php 

use PHPUnit\Framework\TestCase;
require_once 'controladores/Pagos.controlador.php';

/**
 * Pruebas
 */
class PagosTest extends TestCase
{
	/** @test **/
	public function probarMetodoProcesarPago()
	{

		$datos = array('id_orden' => 'Zapatos elegantes 3',
					   'descripcion' => 'jairzeapaez@gmail.com',
					   'precio' => '3217098185');


		$resultado = PagosControlador::ctrProcesarPago($datos);
		echo '<pre>'; print_r($resultado); echo '</pre>';

		// $this->assertEquals(200, $resultado['status']);

	}

}