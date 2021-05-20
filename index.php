<?php

require_once 'vendor/autoload.php';

require_once 'controladores/general.controlador.php';
require_once 'modelos/general.modelo.php';
require_once 'helpers/helper_general.php';

require_once 'controladores/plantilla.controlador.php';
require_once 'controladores/administradores.controlador.php';
require_once 'controladores/capacitaciones.controlador.php';
require_once 'controladores/preguntas.controlador.php';
require_once 'controladores/evaluaciones.controlador.php';
require_once 'controladores/empresas.controlador.php';
require_once 'controladores/usuarios.controlador.php';
require_once 'controladores/ruta.controlador.php';
require_once 'controladores/reportes.controlador.php';
require_once 'controladores/temas.controlador.php';

require_once 'modelos/administradores.modelo.php';
require_once 'modelos/capacitaciones.modelo.php';
require_once 'modelos/preguntas.modelo.php';
require_once 'modelos/evaluaciones.modelo.php';
require_once 'modelos/empresas.modelo.php';
require_once 'modelos/usuarios.modelo.php';
require_once 'modelos/reportes.modelo.php';
require_once 'modelos/temas.modelo.php';

require_once 'extensiones/PHPMailer/src/Exception.php';
require_once 'extensiones/PHPMailer/src/PHPMailer.php';
require_once 'extensiones/PHPMailer/src/SMTP.php';

$index = new ControladorPlantilla();
$index -> ctrPlantilla();