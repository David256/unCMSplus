<?php 

include("ajuste.php");
include("code/CMS.php");

$cms = new unCMSplus($tema,$base_url);
$cms->definirHead($titulo, $descripcion);
$cms->definePagina($lema);
$cms->cargarTema();
$cms->prepararHead();
$cms->definirFooter('Proyecto de programación en PHP para implementar un gestor de contenido+');
$cms->prepararPagina();

//buscamos a ver si es la página principal o un blog
if(!empty($_GET['b'])){
	//no es principal
	$cms->cargarBlog($_GET['b']);
}else{
	//si lo es
	$cms->cargarTodo();
}


$cms->mostrarTodo();

 ?>
