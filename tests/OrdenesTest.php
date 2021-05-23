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

		$this->assertArrayHaskey('id', $resultado[0]);
		$this->assertArrayHaskey('name', $resultado[0]);
		$this->assertArrayHaskey('price', $resultado[0]);

	}

	/** @test **/
	public function probarMostarUnSoloProducto()
	{
		$item = 'id';
		$valor = 1;

		$resultado = OrdenesControlador::ctrMostrarOrdenes($item, $valor);

		$this->assertArrayHaskey('id', $resultado);
		$this->assertArrayHaskey('name', $resultado);
		$this->assertArrayHaskey('price', $resultado);

	}

	/** @test **/
	public function probarCrearUnProducto()
	{
		$datos = array('nombreProducto' => 'Producto 1',
					   'descripcionProducto' => 'Producto de prueba',
					   'precioProducto' => '100000',
					   'imgProducto' => 'https://i2.wp.com/www.zapatos.shopping/wp-content/uploads/2015/01/zapatos-hombre.jpg');
		
		$resultado = OrdenesControlador::ctrCrearOrdenes($datos);

		$this->assertEquals(200, $resultado['status']);

	}

	/** @test **/
	public function probarEditarUnProducto()
	{
		$datos = array('nombreProducto' => 'Producto Editado',
					   'descripcionProducto' => 'Producto de prueba',
					   'precioProducto' => '100000',
					   'imgProducto' => 'https://i2.wp.com/www.zapatos.shopping/wp-content/uploads/2015/01/zapatos-hombre.jpg',
						'id' => 12);
		
		$resultado = OrdenesControlador::ctrEditarOrdenes($datos);

		$this->assertEquals(200, $resultado['status']);

	}

	/** @test **/
	public function probarEliminarUnProducto()
	{
		$id = '19'; /*Asigne un ID existente para realizar la prueba*/
		
		$resultado = OrdenesControlador::ctrEliminarProducto($id);

		$this->assertEquals(200, $resultado['status']);

	}
}