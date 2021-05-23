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

			return $stmt -> fetchAll();

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

	static public function mdlCrearOrden($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(customer_name, customer_email, customer_mobile, id_product, status, id_cliente, llave_secreta, token) VALUES (:customer_name, :customer_email, :customer_mobile, :id_product, :status, :id_cliente, :llave_secreta, :token)");

		$stmt->bindParam(":customer_name", $datos["customer_name"], PDO::PARAM_STR);
		$stmt->bindParam(":customer_mobile", $datos["customer_mobile"], PDO::PARAM_STR);
		$stmt->bindParam(":customer_email", $datos["customer_email"], PDO::PARAM_STR);
		$stmt->bindParam(":id_product", $datos["id_product"], PDO::PARAM_STR);
		$stmt->bindParam(":status", $datos["status"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":llave_secreta", $datos["llave_secreta"], PDO::PARAM_STR);
		$stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);

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

	static public function mdlActualizarOrden($tabla, $respPlace){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET requestId = :requestId, reference = :reference, processUrl = :processUrl WHERE id = :id");

		$stmt->bindParam(":requestId", $respPlace["requestId"], PDO::PARAM_STR);
		$stmt->bindParam(":reference", $respPlace["reference"], PDO::PARAM_STR);
		$stmt->bindParam(":processUrl", $respPlace["processUrl"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $respPlace["id"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return $stmt->errorInfo();	

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	ACTUALIZAR ORDEN SEGUN RESPUESTA DE PASARELA
	=============================================*/

	static public function mdlActualizarOrdenRespuesta($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET status = :status, message = :message, date_trans = :date_trans, method = :method, ref_int = :ref_int, bank = :bank WHERE reference = :reference");

		$stmt->bindParam(":status", $datos["status"], PDO::PARAM_STR);
		$stmt->bindParam(":message", $datos["message"], PDO::PARAM_STR);
		$stmt->bindParam(":date_trans", $datos["date_trans"], PDO::PARAM_STR);
		$stmt->bindParam(":method", $datos["method"], PDO::PARAM_STR);
		$stmt->bindParam(":ref_int", $datos["ref_int"], PDO::PARAM_STR);
		$stmt->bindParam(":bank", $datos["bank"], PDO::PARAM_STR);
		$stmt->bindParam(":reference", $datos["reference"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return $stmt->errorInfo();	

		}

		$stmt -> close();

		$stmt = null;

	}

}