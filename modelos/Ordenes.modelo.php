<?php

require_once "conexion.php";

class OrdenesModelo
{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarOrdenes($tabla, $item, $valor)
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
	REGISTRO DE Ordenes
	=============================================*/

	static public function mdlCrearOrdenes($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(name, description, price, img) VALUES (:nombre, :descripcion, :precio, :imagen)");

		$stmt->bindParam(":nombre", $datos["nombreOrden"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcionOrden"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precioOrden"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imgOrden"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	EDITAR Ordenes
	=============================================*/

	static public function mdlEditarOrden($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET name = :nombre, description = :descripcion, price = :precio, img = :imagen WHERE id = :id");

		$stmt->bindParam(":nombre", $datos["nombreOrden"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcionOrden"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precioOrden"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imgOrden"], PDO::PARAM_STR);
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

	static public function mdlEliminarOrden($tabla, $datos){

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