<?php

require_once "vendor/autoload.php";

require_once "controladores/Rutas.php";
require_once "controladores/Plantilla.controlador.php";

require_once "controladores/Ordenes.controlador.php";
require_once "controladores/ResumenOrdenes.controlador.php";
require_once "controladores/Pagos.controlador.php";


require_once "modelos/Conexion.php";
require_once "modelos/Productos.modelo.php";
require_once "modelos/Ordenes.modelo.php";
require_once "modelos/ResumenOrdenes.modelo.php";

$index = new PlantillaControlador();
$index -> ctrPlantilla();