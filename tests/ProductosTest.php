<?php 

use PHPUnit\Framework\TestCase;
require_once 'controladores/Productos.controlador.php';
require_once 'modelos/Productos.modelo.php';

/**
 * Pruebas
 */
class ProductosTest extends TestCase
{
	/** @test **/
	public function probarMostarTodosLosProductos()
	{
		$item = null;
		$valor = null;

		$resultado = ProductosControlador::ctrMostrarProductos($item, $valor);

		$this->assertArrayHaskey('id', $resultado[0]);
		$this->assertArrayHaskey('name', $resultado[0]);
		$this->assertArrayHaskey('price', $resultado[0]);

	}

	/** @test **/
	public function probarMostarUnSoloProducto()
	{
		$item = 'id';
		$valor = 1;

		$resultado = ProductosControlador::ctrMostrarProductos($item, $valor);

		$this->assertArrayHaskey('id', $resultado);
		$this->assertArrayHaskey('name', $resultado);
		$this->assertArrayHaskey('price', $resultado);

	}

	/** @test **/
	public function probarCrearUnProducto()
	{
		$datos = array('id' => '02',
					   'nombre' => 'Producto de prueba');
		
		$resultado = ProductosControlador::ctrCrearProductos($datos);

		$this->assertEquals(200, $resultado['status']);

	}
}