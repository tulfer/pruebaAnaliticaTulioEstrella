<?php
require 'config/central.php';
require 'modelos/padreModelo.php';

$padrem=new padreModelo();
$bd = $padrem->conectarBaseDatos();
require_once 'controles/kernel.php';

?>
