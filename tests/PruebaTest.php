<?php 

use PHPUnit\Framework\TestCase;

/**
 * Pruebas
 */
class PruebaTest extends TestCase
{
	/** @test **/
	public function probarQueDosMasDosEsCuatro()
	{
		$res = 2 + 2;
		$this->assertEquals(4, $res);
	}
}