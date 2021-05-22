<?php

require_once 'vendor/autoload.php';

require_once "controladores/Rutas.php";
require_once "controladores/Plantilla.controlador.php";

require_once "controladores/Productos.controlador.php";
require_once "modelos/Productos.modelo.php";


$index = new PlantillaControlador();
$index -> ctrPlantilla();