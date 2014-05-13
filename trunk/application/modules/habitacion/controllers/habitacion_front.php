<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class habitacion_front extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;

		if ($this->session->userdata('idioma') =='') $this->session->set_userdata('idioma','es');
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		$this->id_idioma = modules::run('idioma/get_idioma_id_from_code',$this->session->userdata('idioma'));
		$this->lang->load('front');
		
		$this->load->model('habitacion_model');
	}
	
	function index()
	{
		$this->habitaciones;
	}
	
	function habitaciones()
	{
		
		//Datos
		$data['habitaciones'] = $this->habitacion_model->get_habitaciones();
		
		//Info head
		$data['head_title'] = lang('nombre_principal').' | '.lang('front.habitaciones');
		$data['head_descripcion'] = lang('front.habitaciones_desc'); 
		
		//CARGO EL CONTENIDO PRINCIPAL EN LA PAGINA 
		$data['contenido_principal'] 	= $this->load->view('front/habitaciones', $data, true);
		
		//CARGO EL CONTENIDO PRINCIPAL CON LA AYUDA DEL TEMPLATE
		$this->load->view('front/template',$data);
	}
	
		
	function habitacion_detalle($url)
	{
		//datos
		$data['habitacion'] = $this->habitacion_model->get_habitacion_url($url);
		
		//Info head
		$data['head_title'] = lang('nombre_principal'). ' | '.lang('front.gastronomia');
		$data['head_descripcion'] = lang('front.gastronomia_desc'); 
		
		//CARGO EL CONTENIDO PRINCIPAL EN LA PAGINA 
		$data['contenido_principal'] 	= $this->load->view('front/detalle_habitacion', $data, true);
		
		//CARGO EL CONTENIDO PRINCIPAL CON LA AYUDA DEL TEMPLATE
		$this->load->view('front/template',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */