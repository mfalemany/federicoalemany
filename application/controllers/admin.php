<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/admin
	 *	- or -  
	 * 		http://example.com/index.php/admin/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/admin/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model("admin_model");
		$this->load->helper('form');
	}
	
	public function index(){
		if($this->session->userdata('usuario')){
			if(strtolower($this->session->userdata('usuario'))=="admin"){
				//obtengo las categorias para pasarle a la vista
				$data['categorias'] = $this->obtengo_categorias();
				//y tambien los comentarios que no fueron respondidos
				$data['comentarios'] = $this->admin_model->obtener_comentarios(0);
				$this->load->view('includes/cabecera_view');
				$this->load->view('admin/admin_view',$data);
				$this->load->view('includes/footer_view');	
			}
		}else{
			$this->load->view('includes/cabecera_view');
			$this->load->view('admin/login_view');
			$this->load->view('includes/footer_view');	
		}
	}

	public function guardo_categoria(){
		if($this->admin_model->guardar_categoria($this->input->post("categoria"))):
			?>
				<script>
					alert("Categoria guardada!");
					window.location.href="<?php echo base_url(); ?>index.php/admin";
				</script>				
			<?php
			
		endif;
	}
	
	public function obtengo_categorias(){
		return $this->admin_model->obtener_categorias();
	}

	public function login(){
		if($this->admin_model->verifico_login($this->input->post("user"),$this->input->post("pass"))){
			redirect('admin');	
		}
		
	}

	public function cerrar_sesion(){
		$this->session->sess_destroy();
		redirect("inicio");
	}



	public function guardar_post(){
		//le doy un nombre al azar a la imagen
		$nombre_imagen = time();

		$config['upload_path'] = 'assets/imagenes/posts';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = $nombre_imagen;

		$this->load->library('upload',$config);
		
		if($this->upload->do_upload()):
			if($this->admin_model->guardo_post(ucfirst($this->input->post('titulo_post')), $this->input->post('contenido_post'), $this->input->post('categoria'), $this->upload->data('file_name'))): ?>
				<script>
					alert("Articulo publicado con exito!");
					window.location.href='<?php echo base_url(); ?>index.php/admin';
				</script>
			<?php 
			else:
				echo "Error al registrar el post en la base de datos.";
			endif;
		else:
				echo "Error al subir la imagen al servidor<br>";
				echo $this->upload->display_errors();

		endif;
	}

	public function subir_imagen(){

		$ruta= "assets/imagenes/posts/";
		if($_FILES['imagen']['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
			$nombre = strtolower($_FILES['imagen']['name']);//Obtenemos el nombre del archivo
			$temporal = $_FILES['imagen']['tmp_name']; //Obtenemos el nombre del archivo temporal
			copy($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
			//El echo es para que lo reciba jquery y lo ponga en el div "cargados"
			echo json_encode(array("nombre"=>$nombre,"ruta"=>base_url().$ruta));
		}else{
			echo $key['error']; //Si no se cargo mostramos el error
		}
		
	}

	public function responder(){
		$this->admin_model->guardar_comentario("Federico Alemany",$_POST['respuesta'],$_POST['utc']);
		$this->admin_model->marcar_respondido($_POST['comentario']);
	}

	public function marcar_respondido(){
		$this->admin_model->marcar_respondido($this->input->post('id_comentario'));
	}

	
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */