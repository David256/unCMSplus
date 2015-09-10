<?php 

include("ajuste.php");
include("code/CMS.php");

$cms = new unCMSplus($tema,$base_url);
$cms->definirHead($titulo, $descripcion);
$cms->definePagina($lema);
$cms->cargarTema();
$cms->prepararHead();
$cms->mostrarTodo();

 ?>
