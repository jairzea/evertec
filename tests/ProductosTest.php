<?php 

use PHPUnit\Framework\TestCase;
require_once 'controladores/Productos.controlador.php';

/**
 * Pruebas
 */
class ProductosTest extends TestCase
{
	/** @test **/
	public function probarMostarProductos()
	{
		$resultado = ProductosControlador::ctrMostrarProductos();

		$this->assertArrayHaskey('id', $resultado);
		$this->assertArrayHaskey('nombre', $resultado);

	}
}