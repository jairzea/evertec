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
		$datos = array('nombreProducto' => 'Producto 1',
					   'descripcionProducto' => 'Producto de prueba',
					   'precioProducto' => '100000',
					   'imgProducto' => 'https://i2.wp.com/www.zapatos.shopping/wp-content/uploads/2015/01/zapatos-hombre.jpg');
		
		$resultado = ProductosControlador::ctrCrearProductos($datos);

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
		
		$resultado = ProductosControlador::ctrEditarProductos($datos);

		$this->assertEquals(200, $resultado['status']);

	}

	/** @test **/
	public function probarEliminarUnProducto()
	{
		$id = '19'; /*Asigne un ID existente para realizar la prueba*/
		
		$resultado = ProductosControlador::ctrEliminarProducto($id);

		$this->assertEquals(200, $resultado['status']);

	}
}