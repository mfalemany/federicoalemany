<?php 
class Paginacion{
	//funcion que va a manejar la paginacion
	private $manejador;
	//cantidad total de resultados que se va a manejar
	private $total_resultados = 10;
	//cantidad de resultados que se mostrará por cada pagina
	private $por_pagina = 2;
	//tag para apertura y cierre de la paginacion completa
	private $tag_aper_pag;
	private $tag_cierre_pag;
	//tag para apertura y cierre de la cada elemento
	private $tag_aper_boton;
	private $tag_cierre_boton;
	//tag para apertura y cierre de la cada elemento
	private $tag_aper_actual;
	private $tag_cierre_actual;
	//segmento URI que contiene la pagina actual
	private $segmento_uri;

	public function inicializar($config){
		foreach ($config as $key => $value){
			$this->$key = $value;
		}
	}


	public function obtener_enlaces(){
		//se usa trim para eliminar la primera barra.
		$segmentos = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
		if( array_key_exists($this->segmento_uri, $segmentos) ){
			$actual = $segmentos[$this->segmento_uri];	
		}else{
			$actual = 1;
		}
		


		$cantidad_paginas = ceil($this->total_resultados / $this->por_pagina);
		//si se ha establecido, se muestra el tag de apertura
		if ($this->tag_aper_pag){ echo $this->tag_aper_pag; };
		
		for($i = 1; $i <= $cantidad_paginas; $i++){
			//si se ha establecido, se muestra el tag de apertura para cada elemento individualmente
			if ($this->tag_aper_boton){ echo $this->tag_aper_boton; };

			

			if($actual == $i){ 
				//si se establecio un tag de apertura para el elemento actual, se muestra
				if ( $this->tag_aper_actual ){ echo $this->tag_aper_actual;	}
				
				echo "<a>$i</a>"; 

				//cierre de tag actual (solo si se establecio)
				if ( $this->tag_cierre_actual ){ echo $this->tag_cierre_actual;	}
			}else{
				echo "<a href='".$this->manejador.$i."'>$i</a>"; 
			}

			

			//si se ha establecido, se muestra el tag de apertura para cada elemento individualmente
			if ($this->tag_cierre_boton){ echo $this->tag_cierre_boton; };
		}
		//si se ha establecido, se muestra el tag de cierre
		if ($this->tag_cierre_pag){ echo $this->tag_cierre_pag; };
	}
}
?>