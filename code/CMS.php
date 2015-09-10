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
	private $textoFooter;

	function __construct($ruta, $base){
		$this->tema_elegido = $ruta;
		$this->base_url = $base;
	}

	//buscamos los archivos del tema
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
		fclose($plantilla);
	}

	//definimos valores como titulo y descripcion
	function definirHead($titulo, $descripcion){
		$this->titulo = $titulo;
		$this->descripcion = $descripcion;
	}

	//definimos el valor del lema
	function definePagina($lema){
		$this->lema = $lema;
	}

	//definimos valor para el footer
	function definirFooter($texto){
		$this->textoFooter = $texto;
	}

	//mostramos todo el resultado
	function mostrarTodo(){
		echo $this->contenido;
	}

	//preparamos la cabecera head
	function prepararHead(){
		$this->contenido = str_replace('{plus:title blog}', 'Index', $this->contenido);
		$this->contenido = str_replace('{plus:title pagina}', $this->titulo, $this->contenido); //{plus:tema ruta}
		$this->contenido = str_replace('{plus:tema ruta}', '.'.$this->ruta_tema, $this->contenido);
		$this->contenido = str_replace('{plus:descripcion}', $this->descripcion, $this->contenido);
		$this->contenido = str_replace('{plus:descripcion}', $this->descripcion, $this->contenido);
	}

	//preparamos el valor lema y footer
	function prepararPagina(){
		$this->contenido = str_replace('{plus:lema}', $this->lema, $this->contenido);
		$this->contenido = str_replace('{plus:footer}', $this->textoFooter, $this->contenido);
	}

	//carga el blog especifico
	function cargarBlog($ruta){
		$lugarInicio = strpos($this->contenido, '{plus:section otro}') + strlen('{plus:section otro}');
		$lugarSiFin = strpos($this->contenido, '{plus:section fin si}');
		$tamano = strlen($this->contenido);
		$extracto = substr($this->contenido, $lugarInicio, $lugarSiFin - $lugarInicio);

		//cargamos el blog
		$direccion = './blog/' . $ruta . '.html';
		$elBlog = '';
		if(file_exists($direccion)){
			$handleBlog = fopen($direccion, 'r');
			$contenido = fread($handleBlog, filesize($direccion));
			fclose($handleBlog);
			$elBlog = $contenido;
		}else{
			$elBlog = 'página no encontrada :( ';
		}
		
		//mejoramos el extracto
		$extracto = str_replace('{plus:articulo titulo}', 'Un blog más', $extracto); //por ahora
		$extracto = str_replace('{plus:article contenido}', $elBlog, $extracto);

		//guardamos todo
		$lugarInicio = strpos($this->contenido, '{plus:section si lobby}');
		$lugarFin = strpos($this->contenido, '{plus:section fin si}') + strlen('{plus:section fin si}');
		//desde inicio hasta lugarInicio y desde lugarFin todo el resto de documento
		$parteA = substr($this->contenido, 0, $lugarInicio);
		$parteB = substr($this->contenido, $lugarFin);
		$this->contenido = $parteA . $extracto . $parteB;
	}

	//cargamos todos los blogs
	function cargarTodo(){

	}


}

 ?>