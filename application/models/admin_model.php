<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			
		}

		public function guardar_categoria($categoria){
			$invalidos = array("'","\"","<",">","sleep","insert","delete");
			$filtrado = str_replace($invalidos, "@", $categoria);
			$data = array(
			   'id_categoria' => NULL,
			   'categoria' => $filtrado ,
			   'activo' => 1
			);

			if($this->db->insert('categorias', $data)){
				return true;
			}else{
				return true;
			}; 
		}

		public function obtener_categorias(){
			$this->db->order_by("categoria", "asc"); 
			$categorias = $this->db->get("categorias");
			return $categorias->result_array();
		}

		public function obtener_categoria($id){
			$this->db->limit(1);
			$this->db->where("id_categoria",$id);
			$categorias = $this->db->get("categorias");
			//var_dump($categorias->result_array()); die;
			foreach ($categorias->result_array() as $value) {
				return $value['categoria'];
			}
		}

		public function total_registros($tabla){
			return $this->db->count_all_results($tabla);
		}

		public function verifico_login($usuario, $clave){

			$this->db->where("usuario", $usuario);
			$this->db->where("clave", sha1($clave));
			$this->db->where("activo", 1);
			$this->db->limit(1);
			$resultado = $this->db->get("usuarios");
			if($resultado->num_rows() > 0){
				foreach ($resultado->result_array() as $value) {
					
					$datos_sesion = array(
						"id_usuario"=>$value['id_usuario'],
						"usuario"=>$value['usuario'],
						"nombre_pila"=>$value['nombre_pila'],
						"privilegio"=>$value['privilegio']
						);
					$this->session->set_userdata($datos_sesion);
					return TRUE;
				}
			}else{
				return FALSE;
			}
		}

		public function guardo_post($titulo, $contenido, $categoria, $imagen){
			
			$this->db->set('utc',time());
			$this->db->set('titulo' , $titulo);
			$this->db->set('contenido' , $contenido);
			$this->db->set('categoria' , $categoria);
			$this->db->set('imagen' , $imagen['file_name']);
			$this->db->set('cant_visitas' , 0);
			
			if($this->db->insert('post')){

				return TRUE;
			}else{
				return FALSE;
			}

		}
		
		public function visitar_post($id){
			$this->db->query('UPDATE post SET cant_visitas = cant_visitas + 1 WHERE utc = '.$id);
		}

		public function nombre_post($utc){
			$this->db->select('titulo');
			$this->db->where('utc',$utc);
			$this->db->limit(1);
			$consulta = $this->db->get('post');
			$nombre = $consulta->result_array(); 
			return $nombre[0]['titulo'];

		}
		
		//si a este metodo no se le pasan argumentos, devuelve todos los post, sin filtros
		public function obtener_post($utc = 0, $categoria = 0, $criterio = "", $pagina = 1, $por_pagina = 0){
			if($utc!=0){
				$this->db->where("utc",$utc);
			}
			if($categoria!=0){
				$this->db->where("categoria",$categoria);
			}
			if($criterio!=""){
				$this->db->like("titulo",$criterio);
			}
			$this->db->order_by('utc','desc');
			if($pagina > 1 && $por_pagina > 0){
				$offset = $por_pagina * ($pagina - 1) ;
				$consulta = $this->db->get("post",$por_pagina,$offset);		
			}else{
				$consulta = $this->db->get("post",$por_pagina);
			}
			return $consulta->result_array();
		}

		public function obtener_top_cinco(){
			$this->db->limit(5);
			$this->db->order_by('cant_visitas','desc');
			$consulta = $this->db->get("post");
			return $consulta->result_array();
		}

		public function guardar_comentario($nombre,$comentario,$post){
			$data = array(
			   'id_comentario' => NULL,
			   'utc' => $post,
			   'nombre' => $nombre,
			   'comentario' => $comentario,
			   'fecha' => date("d-m-Y"),
			   'hora' => date("H:i")
			);
			//esto es para que no me sugiera responder algo que escribi yo
			if(strtolower($nombre) == 'federico alemany'){$data['respondido'] = 1;}
			$this->db->insert('comentarios', $data); 
			
		}
		public function marcar_respondido($id_comentario){
			$this->db->query('UPDATE comentarios SET respondido = 1 WHERE id_comentario = '.$id_comentario);
		}

		public function obtener_comentarios($post){
			//esta funcion me devuelve los comentarios de un post en particular (si le paso un id)
			//o me devuelve todos los comentarios sin responder (para la vista de administrador)
			if($post!=0){
				$this->db->where("utc",$post);	
			}else{
				$this->db->where("respondido",0);	
			}
			$consulta = $this->db->get("comentarios");
			return $consulta->result_array();
		}

	}

	
 
	
?>