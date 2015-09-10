<?php 

class unCMSplus{
	private $tema_elegido;
	private $base_url;
	private $ruta_tema;

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
			$this->tema_elegido = '/tema/defecto';
		}
		//cargamos lo que obtuvimos
		
	}
}

 ?>