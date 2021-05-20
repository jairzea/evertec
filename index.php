<?php

require_once 'vendor/autoload.php';

require_once 'extensiones/PHPMailer/src/Exception.php';
require_once 'extensiones/PHPMailer/src/PHPMailer.php';
require_once 'extensiones/PHPMailer/src/SMTP.php';

$index = new ControladorPlantilla();
$index -> ctrPlantilla();