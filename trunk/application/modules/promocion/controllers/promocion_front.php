<?php

class promocion_front extends MX_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;

		if ($this->session->userdata('idioma') =='') $this->session->set_userdata('idioma','es');
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		$this->id_idioma = modules::run('idioma/get_idioma_id_from_code',$this->session->userdata('idioma'));
		$this->lang->load('front');
		
		$this->load->model('promocion/promocion_model');
	}
	
	function index()
	{
		$this->promociones();
	}
	
	function promociones()
	{
		//Datos
		$data['promociones'] = $this->promocion_model->get_promociones();
		
		//Info head
		$data['head_title'] = lang('nombre_principal').' | '.lang('front.promociones');
		$data['head_descripcion'] = lang('front.promociones_desc');
		
		$data['contenido_principal'] = $this->load->view('front/promociones', $data, true);
		$this->load->view('front/template', $data);
	}
	
	function promociones_eventos()
	{
		//Promociones
		$data['promociones'] = $this->promocion_model->get_promociones();
		
		//Eventos
		$this->load->model('evento/evento_model');
		$this->load->helper('text');
		$data['eventos'] = $this->evento_model->get_eventos_reuniones();
			
		//Promociones especiales
		$data['especiales'] = $this->promocion_model->get_promociones_especiales();
		
		//Info head
		$data['head_title'] = lang('nombre_principal').' | '.lang('front.promociones') .' & '.lang('front.eventos');
		$data['head_descripcion'] = lang('front.promociones_desc');
		
		$data['contenido_principal'] = $this->load->view('front/promociones_eventos', $data, true);
		$this->load->view('front/template', $data);
	}
	
	//======================================== EJEMPLO RSS NO BORRAR NUNCA =============================================
	function listado_promociones($promocion = '')
	{
		$this->load->model('banner/banner_model');
		$this->load->model('noticia/noticia_model');
		
		if (is_numeric($promocion) || empty($promocion))
			$id_promocion = $promocion;
		else
			$id_promocion = $this->promocion_model->get_id_from_url($promocion);
		
		$terminos_busqueda['promocion.id_estado'] = 1;
		
		$data['promociones'] 		= $this->promocion_model->get_page(0,10,'promocion.id_promocion','desc','front',$terminos_busqueda);
		$data['promocion_actual'] 	= $this->promocion_model->read($id_promocion);
		
		if(empty($promocion))
			$nombre = $data['promociones'][0]->nombre;
		else
			$nombre = $data['promocion_actual']->nombre;
		
		$nombre = ucfirst(strtolower($nombre));
		
		$data['title'] = lang('promociones').' - '.$nombre.' - '.lang('carpasmare');
		
		$data['meta_descripcion'] 	= lang('promo.meta_description');
		$data['meta_keywords'] 		= lang('promo.meta_keywords');
		$data['breadcrumbs'] 		= $this->menus->create_breadcrumb(
    															array(
    																	lang('inicio_url') => lang('inicio.breadcrumb'),
    																	lang('promociones_url') => lang('promociones')
																	 )
									 						  );
		
		//$banners = $this->banner_model->get_page(0,10,'banner.id_banner','desc',array('banner.id_estado' => 1));
		//$data['front_banner'] = get_front_banners($banners);
		//$data['noticias_footer'] = $this->noticia_model->get_page(0,4,'noticia.id_noticia','desc','front',array('noticia.id_estado' => 1));
		
		$data['contenido_principal'] = $this->load->view('front/promocion_listado', $data, true);
		
		$this->load->view('front/template', $data);
	}
	
	function rss_promociones()
	{
        $this->load->model('promocion/promocion_model');

        $promociones = $this->promocion_model->ultimas_promociones();

        //Titulo del feed
        $data['titulo'] = 'RSS Promociones Hesperia';

        //La url del feed
        $data['feed_url'] = base_url();

        //Descripción de la página
        $data['page_description'] = 'Últimas promociones ofrecidas en nuestro hotel Hesperia';

		//Fecha de ultima publicacion
		$data['pub_date'] = $promociones[0]->creado;
		
        //Email del autor
        $data['creator_email'] = 'wintech.proyecto@gmail.com';
		
		//Email del autor
        $data['autor_per_post'] = 'Hesperia';
		
        //Esto le permitirá al navegador mostrar la salida en formato XML, importantísimo el charset en utf-8
        //header("Content-Type: application/rss+xml; charset=utf-8");

        //HTML
        header('Content-Type: text/html; charset=utf-8');
        //header("Content-type: text/xml");

        //El array con los posts que hemos pedido al modelo
        $data['feeds'] = $promociones;

        $this->load->view('front/rss_promociones', $data);
	   
	}

}
/* End of file exposicion_front.php */

