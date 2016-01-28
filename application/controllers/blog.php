<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {
	public $mostrar_paginas;
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/blog
	 *	- or -  
	 * 		http://example.com/index.php/blog/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/blog/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->library("Paginacion");
		$this->load->model("admin_model");

	}
	public function index($pagina = 1){
		$this->mostrar_paginas = TRUE;
		$configuracion = array(
								"manejador"=>base_url()."index.php/blog/index/",
								"total_resultados"=>$this->admin_model->total_registros("post"),
								"por_pagina"=>2,
								"tag_aper_pag"=>"<div id='paginacion'>",
								"tag_cierre_pag"=>"</div>",
								"tag_aper_boton"=>"<span class='paginacion_boton'>",
								"tag_cierre_boton"=>"</span>",
								"tag_aper_actual"=>"<span class='paginacion_actual'>",
								"tag_cierre_actual"=>"</span>",
								"segmento_uri"=>3

			);
		$this->paginacion->inicializar($configuracion);


		//categorias para el menu lateral
		$data['categorias'] = $this->admin_model->obtener_categorias();
		//post para mostrar en el top cinco
		$data['topcinco'] = $this->admin_model->obtener_top_cinco();
		//post para mostrar en el cuerpo de la pantalla
		
		$data['posts'] = $this->admin_model->obtener_post(0,0,"", $pagina, $configuracion['por_pagina']);

		$this->load->view('includes/cabecera_view');
		$this->load->view('blog/blog_view',$data);
		$this->load->view('includes/footer_view');
	}

	public function ver_post($id=NULL){
$this->mostrar_paginas = FALSE;
		if($id==NULL){
			redirect('blog');
		}
		//categorias para el menu lateral
		$data['categorias'] = $this->admin_model->obtener_categorias();
		//post para mostrar en el top cinco
		$data['topcinco'] = $this->admin_model->obtener_top_cinco();
		// obtener_post($id, $categoria,$criterio)  0: no aplica filtro
		$data['post'] = $this->admin_model->obtener_post($id,0,"",0,1);
		//le agregamos una visita al post
		$this->admin_model->visitar_post($id);

		$this->load->view("includes/cabecera_view");
		$this->load->view("blog/post_view",$data);
		$this->load->view("includes/footer_view");
	}
	public function buscar_posts(){
		$this->mostrar_paginas = FALSE;
		//categorias para el menu lateral
		$data['categorias'] = $this->admin_model->obtener_categorias();
		//post para mostrar en el top cinco
		$data['topcinco'] = $this->admin_model->obtener_top_cinco();
		$data['categorias'] = $this->admin_model->obtener_categorias();
		//echo "criterio ndae=".$this->input->post('criterio'); die;
		$data['posts'] = $this->admin_model->obtener_post(0,0,$this->input->post('criterio'),0,1);
		$this->load->view('includes/cabecera_view');
		$this->load->view('blog/blog_view',$data);
		$this->load->view('includes/footer_view');
	}

	public function ver_categoria($id_categoria){
		$this->mostrar_paginas = FALSE;
		//categorias para el menu lateral
		$data['categorias'] = $this->admin_model->obtener_categorias();
		//post para mostrar en el top cinco
		$data['topcinco'] = $this->admin_model->obtener_top_cinco();
		$data['categorias'] = $this->admin_model->obtener_categorias();
		$data['posts'] = $this->admin_model->obtener_post(0,$id_categoria,"",1,100);
		
		//la variable clase se usa para mostrarla en la cabecera
		if($id_categoria!=0){
			$data['clase'] = strtolower(str_replace(" ", "_", $this->admin_model->obtener_categoria($id_categoria)));	
		}
		

		$this->load->view('includes/cabecera_view');
		$this->load->view('blog/blog_view',$data);
		$this->load->view('includes/footer_view');
	}

	public function guardo_comentario(){
		$this->admin_model->guardar_comentario($this->input->post('nombre'),$this->input->post('comentario'),$this->input->post('post'));
		mail("mfalemany@gmail.com","Nuevo comentario en un articulo de federicoalemany.com",'El comentario fue en el post '.$this->input->post('post'));
	}

	public function cargar_comentarios($post){
		$comentarios = $this->admin_model->obtener_comentarios($post);
		foreach ($comentarios as $key => $value) {
		echo'<div class="cuadro_comentarios">
				<div class="comentario">
					<div id="bocadillo"></div>
					<div id="detalles_comentario">
						<div><span id="usuario_comentario">'.$value['nombre'].'</span> dijo:</div>
						<div id="fecha_hora_comentario"><i>'.$value['fecha'].' - '.$value['hora'].' hs.</i></div>
					</div>
					<div class="limpiar"></div>	
					<div id="texto_comentario">'.$value['comentario'].'</div>
				</div>	
			</div>	
			<br>';
		}
	}
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */