<?php
$view='Inicio';
if(isset($_GET['ruta'])&&$_GET['ruta']!=''){
    $ruta=$_GET['ruta'];
} else {
    $ruta='Inicio';
}
if (isset($_GET['accion'])&&$_GET['accion']!=''){
    $accion=$_GET['accion'];
} else {
    $accion=0;
}

$controller='controles/'.$ruta.'Control.php';

if (file_exists($controller)){
    $modelo ='modelos/'.$ruta.'Modelo.php';
    $modeloClase=$ruta.'Modelo';

    if(file_exists($modelo)){
        require_once $modelo;
        $model = new $modeloClase;
    }

    require_once $controller;
}

require 'public/default.php';
?>
