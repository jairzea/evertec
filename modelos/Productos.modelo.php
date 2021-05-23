<?php

require_once "conexion.php";

class ProductosModelo
{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor)
	{

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE PRODUCTOS
	=============================================*/

	static public function mdlCrearProductos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(name, description, price, img) VALUES (:nombre, :descripcion, :precio, :imagen)");

		$stmt->bindParam(":nombre", $datos["nombreProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcionProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precioProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imgProducto"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTOS
	=============================================*/

	static public function mdlEditarProducto($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET name = :nombre, description = :descripcion, price = :precio, img = :imagen WHERE id = :id");

		$stmt->bindParam(":nombre", $datos["nombreProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcionProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precioProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imgProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return $stmt->errorInfo();	

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return $stmt->errorInfo();	

		}

		$stmt -> close();

		$stmt = null;


	}

}