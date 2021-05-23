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

		$datos = array('id_orden' => '3',
					   'descripcion' => 'Lorem Ipsum es simplemente ',
					   'precio' => '30000');


		$resultado = PagosControlador::ctrProcesarPago($datos);

		$this->assertEquals(200, $resultado['status']);

	}

}