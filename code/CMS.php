<?php 
include('./ajuste.php');
class unCMSplus{
	private $tema_elegido;
	private $base_url;
	private $ruta_tema;
	private $contenido;
	private $titulo;
	private $descripcion;
	private $lema;

	function __construct($ruta, $base){
		$this->tema_elegido = $ruta;
		$this->base_url = $base;
	}

	function cargarTema(){
		$ruta = './' . $this->tema_elegido . '/plantilla.html';
		if(file_exists($ruta)){
			$this->ruta_tema = $this->tema_elegido;
		}else{
			//cargamos la por defecto
			$this->ruta_tema = '/tema/defecto';
		}
		$ruta = './' . $this->ruta_tema;
		//cargamos lo que obtuvimos
		$plantilla = fopen($ruta . '/plantilla.html', 'r');

		$this->contenido = fread($plantilla, filesize($ruta.'/plantilla.html'));
	}

	function definirHead($titulo, $descripcion){
		$this->titulo = $titulo;
		$this->descripcion = $descripcion;
	}

	function definePagina($lema){
		$this->lema = $lema;
	}

	function mostrarTodo(){
		echo $this->contenido;
	}

	function prepararHead(){
		$this->contenido = str_replace('{plus:title blog}', 'Index', $this->contenido);
		$this->contenido = str_replace('{plus:title pagina}', $this->titulo, $this->contenido); //{plus:tema ruta}
		$this->contenido = str_replace('{plus:tema ruta}', '.'.$this->ruta_tema, $this->contenido);
		$this->contenido = str_replace('{plus:descripcion}', $this->descripcion, $this->contenido);
		$this->contenido = str_replace('{plus:descripcion}', $this->descripcion, $this->contenido);
	}

	function prepararPagina(){
		$this->contenido = str_replace('{plus:title blog}', 'Index', $this->contenido);
	}


}

 ?>