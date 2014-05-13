<?php 

class Empresa_front extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;

		if ($this->session->userdata('idioma') =='') $this->session->set_userdata('idioma','es');
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		$this->id_idioma = modules::run('idioma/get_idioma_id_from_code',$this->session->userdata('idioma'));
		$this->lang->load('front');
	}
	
	function index()
	{
		$this->nosotros();
	}

	function nosotros()
	{
		//Info head
		$data['head_title'] = lang('nombre_principal').' | '.lang('front.nosotros');
		$data['head_descripcion'] = lang('front.nosotros_desc');
		
		$data['contenido_principal'] = $this->load->view('nosotros', $data, TRUE);
		$this->load->view('front/template', $data);
	}

	
	function hotel(){
		$this->load->model('noticia/noticia_model');
		$this->load->model('evento/evento_model');
		$data['breadcrumbs'] = array(
										'' => lang('breadcrumb_inicio'),
										lang('hotel_url') => lang('breadcrumb_hotel')
									);
		$data['noticias_footer'] = $this->noticia_model->get_posts(4, 'desc', array('noticia.id_estado' => 1));
		$data['eventos_footer'] = $this->evento_model->get_page(0,4,'evento.id_evento','','front',array('evento.id_estado' => 1));
		$data['main'] = lang('empresa');
		$data['sub'] = lang('empresa_url');
		
		//anterior title
		//$data['title'] = lang('nosotros.meta.title').' - '.lang('inicio.meta.title');
		
		//nuevo title
		$data['title'] = lang('complejo-wtc.meta.title').' - '.lang('menu.wtc-valencia');
		
		
		//anterior meta-descripcion
		//$data['meta_descripcion'] = lang('nosotros.meta.description').' | '.lang('inicio.meta.description');
		
		//nuevo meta-descripcion
		$data['meta_descripcion'] = lang('complejo-wtc.meta.description');
		
		//Google ya no toma en cuenta meta-keywords
		//$data['meta_keywords'] = lang('nosotros.meta.keywords').' | '.lang('inicio.meta.keywords');
		
		$data['contenido_principal'] = $this->load->view('hotel_hesperia_nh', $data, TRUE);
		$this->load->view('front/template', $data);
	}
	



}
/* End of file exposicion_front.php */