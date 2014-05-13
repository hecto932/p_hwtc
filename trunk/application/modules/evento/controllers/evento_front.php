<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Evento_front extends MX_Controller
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
			
			$this->load->model('evento_model');
		}
		
		function index()
		{
			$this->eventos_reuniones();
		}
		
		function eventos_reuniones()
		{
			$this->load->helper('text');
			
			//Datos
			$data['eventos'] = $this->evento_model->get_eventos_reuniones();
			
			//Promociones especiales
			$this->load->model('promocion/promocion_model');
			$data['especiales'] = $this->promocion_model->get_promociones_especiales();
			
			//Info head
			$data['head_title'] = lang('nombre_principal').' | '.lang('front.eventos_reuniones');
			$data['head_descripcion'] = lang('front.eventos_reuniones_desc'); 
			
			//CARGO EL CONTENIDO PRINCIPAL EN LA PAGINA 
			$data['contenido_principal'] = $this->load->view('front/eventos.php', $data, true);
			
			//CARGO EL CONTENIDO PRINCIPAL CON LA AYUDA DEL TEMPLATE
			$this->load->view('front/template',$data);
		}
		
		function listado($inicio = 0)
		{
			$this->load->library('pagination');
			$data = array();
			$multimedia = array();
			
			$data['header_title'] = "Eventos";
			$config['base_url'] = base_url().'eventos/';
      		$config['total_rows'] = $this->evento_model->total_rows();
      		$config['per_page'] = 3;
      		$config['num_links'] = 20;
    		$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['next_link'] = "&rsaquo;";
			$config['next_tag_open'] = '<li class="arrow">';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = "&lsaquo;";
			$config['prev_tag_open'] = '<li class="arrow">';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="current"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['last_link'] = "&raquo;";
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close']= '</li>';
			$config['first_link'] = "&laquo;";
			$config['fist_tag_open'] = '<li>';
			$config['fist_tag_close']= '</li>';
			$config['uri_segment'] = 2;
      		$this->pagination->initialize($config);
			
			$data["pagination"] = $this->evento_model->get_events($config['per_page'], $inicio);
			
			//echo '<pre>'.print_r($data,TRUE).'</pre>';
			
			$data["links_pagination"] = $this->pagination->create_links();
			
			$data['contenido_principal'] = $this->load->view('/front/evento', $data, TRUE);
			$this->load->view('front/template', $data);
		}

		function detalle_evento($url)
		{
			$evento = $this->evento_model->get_evento_url($url);
			if(!empty($evento)) $data["evento"] = $evento[0];
			
			//Info head
			$data['head_title'] = lang('nombre_principal').' | '.lang('front.eventos_reuniones');
			$data['head_descripcion'] = lang('front.eventos_reuniones_desc'); 
			
			//CARGO EL CONTENIDO PRINCIPAL EN LA PAGINA 
			$data['contenido_principal'] = $this->load->view('front/evento_detalle.php', $data, true);
			
			//CARGO EL CONTENIDO PRINCIPAL CON LA AYUDA DEL TEMPLATE
			$this->load->view('front/template',$data);
		}
	}
	
?>
