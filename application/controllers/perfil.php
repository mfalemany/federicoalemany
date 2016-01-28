<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/perfil
	 *	- or -  
	 * 		http://example.com/index.php/perfil/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/perfil/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('includes/cabecera_view');
		$this->load->view('perfil/perfil_view');
		$this->load->view('includes/footer_view');
	}
}

/* End of file perfil.php */
/* Location: ./application/controllers/perfil.php */