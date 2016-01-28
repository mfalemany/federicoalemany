<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/inicio
	 *	- or -  
	 * 		http://example.com/index.php/inicio/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/inicio/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$this->load->view('includes/cabecera_view');
		$this->load->view('inicio_view');
		$this->load->view('includes/footer_view');
	}

	public function contacto(){
		$this->load->view('includes/cabecera_view');
		$this->load->view('contacto_view');
		$this->load->view('includes/footer_view');
	}	

	public function envio_mail()
	{
		$mensaje = $this->input->post('mensaje')." ----> Enviado desde: ".$this->input->post('ciudad');
		mail("mfalemany@gmail.com","Nuevo mensaje en federicoalemany.com",$mensaje,'From: '.$this->input->post('email'));
	}

}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */