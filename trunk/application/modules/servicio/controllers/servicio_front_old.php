<?php

class Servicio_front extends MX_Controller {


	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('idioma') == '') $this->session->set_userdata('idioma','es');
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		$this->id_idioma = modules::run('idioma/get_idioma_id_from_code',$this->session->userdata('idioma'));
		$this->load->model('servicio/servicio_model');
		$this->lang->load('front');
	}


	function index($function='nosotros',$id='')
	{
		$this->servicios();
	}


	function servicios($ajax = false)
	{
		$this->load->helper('misc');
		$this->load->model('noticia/noticia_model');
		$this->load->model('evento/evento_model');
		$data['noticias_footer'] = $this->noticia_model->get_posts(4, 'desc', array('noticia.id_estado' => 1,'detalle_noticia.id_idioma'=>$this->id_idioma));
		$data['eventos_footer'] = $this->evento_model->get_page(0, 4, 'evento.id_evento', 'asc', 'front', array('evento.id_estado' => 1,'detalle_evento.id_idioma'=>$this->id_idioma));
		
		//viejo
		//$data['title'] = lang('servicios.meta.title').' - '.lang('inicio.meta.title');
		
		//nuevo
		$data['title'] = lang('servicios.meta.title').' - '.lang('menu.wtc-valencia');
		
		$data['breadcrumbs'] = array(
										'' => lang('breadcrumb_inicio'),
										lang('servicios_url') => lang('breadcrumb_servicios')
									);
		$data['tipo_servicios'] = $this->servicio_model->get_tipo_servicio();
		$data['servicios'] = ordenar_servicios($this->servicio_model->get_all_publicado('es'));
		//echo '<pre>'.print_r($data['servicios'],true).'</pre>';die();
		
		$data['meta_descripcion'] = lang('servicios.meta.description');
		
		//no usado por GOOGLE
	//	$data['meta_keywords'] = lang('servicios_wtc.meta.keywords').' | '.lang('inicio.meta.keywords');
		
		$data['servicios_js']	= $this->load->view('front/js/servicios_js', $data, true);
		$data['contenido_principal'] = $this->load->view('front/servicios_home', $data, true);
		$this->load->view('front/template',$data);
	}


	function hospedaje(){
		$this->load->model('noticia/noticia_model');
		$this->load->model('evento/evento_model');
		$data['noticias_footer'] = $this->noticia_model->get_posts(4, 'desc', array('noticia.id_estado' => 1,'detalle_noticia.id_idioma'=>$this->id_idioma));
		$data['eventos_footer'] = $this->evento_model->get_page(0, 4, 'evento.id_evento', 'asc', 'front', array('evento.id_estado' => 1,'detalle_evento.id_idioma'=>$this->id_idioma));
		$data['habitaciones'] = $this->servicio_model->get_posts(0, array('servicio.id_estado' => 1, 'servicio.id_tipo_servicio' => 1,'detalle_servicio.id_idioma'=>$this->id_idioma));
		//Anteriror $data['title'] = lang('hospedaje.meta.title').' - '.lang('servicios.meta.title').' - '.lang('inicio.meta.title');
		
		//nuevo titulo
		$data['title'] = lang('hospedaje.meta.title');
		
		// anterior $data['meta_descripcion'] = lang('servicios_wtc.meta.description').' | '.lang('inicio.meta.description');
		
		//nueva meta_descripcion
		$data['meta_descripcion'] = lang('hospedaje.meta.description');
		
		//Meta_keywords no necesarias 
		// $data['meta_keywords'] = lang('servicios_wtc.meta.keywords').' | '.lang('inicio.meta.keywords');
		
		$data['breadcrumbs'] = array(
										'' => lang('breadcrumb_inicio'),
										lang('servicios_wtc_url') => lang('breadcrumb_servicios'),
										lang('hospedaje_url') => lang('breadcrumb_hospedaje')
									);
		//$data['hospedaje_js'] = $this->load->view('front/js/hospedaje_js', $data, true);
		$data['contenido_principal'] = $this->load->view('front/servicios_hospedajes', $data, true);
		$this->load->view('front/template',$data);
	}


}
/* End of file servicios_front.php */
